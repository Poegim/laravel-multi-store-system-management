<?php

namespace App\Repositories\CategoryRepository ;

use Illuminate\Support\Carbon;
use App\Models\Warehouse\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function store(array $data)
    {
        $category = new Category;
        $category = $this->associate($category, $data);
        $category->created_at = Carbon::now()->format('Y-m-d H:i:s');
        return $category->save();
    }
    
    public function update(array $data, int $id)
    {
        $category = Category::findOrFail($id);
        $category = $this->associate($category, $data);
        
        /**
         *  Set same state fot all children.
         */
        $this->toggleCategoryChildren($category, $category->disabled);
        
        /**
         *  If category has been enabled, then enable parents.
         */
        if ($category->disabled === false) $this->toggleCategoryParent($category);
        
        $category->updated_at = Carbon::now()->format('Y-m-d H:i:s');
        return $category->save();
    }

    /**
     *
     * Returns tree of active categories.
     * Optionaly exclude child/ren of given parent.
     *
     */
    public function activeTree($excludeChildOf = null)
    {
        Cache::forget('categories_tree');

        //Get enabled categories and build tree.
        $categoryTree = Cache::remember('categories_tree', 60, function () use ($excludeChildOf) {
            $categories = DB::table('categories')
                ->where('disabled', 0)
                ->get()
                ->map(function ($category) {
                    return (array) $category;
                })->all();

            if ($excludeChildOf) {
                $categories = $this->filterOutChildren($categories, $excludeChildOf);
            }

            return $this->buildTree($categories);
        });

        return $categoryTree;
    }

    /**
     *
     * Returns tree of all categories.
     * Optionaly exclude child/ren of given parent.
     *
     */
    public function allTree($excludeChildOf = null)
    {
        Cache::forget('categories_tree');

        //Get all categories and build tree.
        $categoryTree = Cache::remember('categories_tree', 60, function () use ($excludeChildOf) {
            $categories = DB::table('categories')
                ->get()
                ->map(function ($category) {
                    return (array) $category;
                })->all();

            if ($excludeChildOf) {
                $categories = $this->filterOutChildren($categories, $excludeChildOf);
            }

            return $this->buildTree($categories);
        });

        return $categoryTree;
    }

    /**
     *
     * Builds tree structure.
     *
     */
    private function buildTree(array $categories, $parentId = null) {

        $branch = [];

        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $children = $this->buildTree($categories, $category['id']);
                if ($children) {
                    $category['children'] = $children;
                }
                $branch[] = $category;
            }
        }

        return $branch;
    }

    /**
     *
     * Filters out children of the given category.
     *
     */
    private function filterOutChildren(array $categories, $excludeChildOf) {
        $excludedIds = $this->getDescendantIds($categories, $excludeChildOf);
        return array_filter($categories, function ($category) use ($excludedIds) {
            return !in_array($category['id'], $excludedIds);
        });
    }

    /**
     *
     * Recursively gets all descendant IDs of a given category.
     *
     */
    private function getDescendantIds(array $categories, $parentId) {
        $descendants = [];
        
        foreach ($categories as $category) {
            if ($category['parent_id'] == $parentId) {
                $descendants[] = $category['id'];
                $descendants = array_merge($descendants, $this->getDescendantIds($categories, $category['id']));
            }
        }

        return $descendants;
    }

    private function associate(Category $category, array $data)
    {
        $category->plural_name = $data['plural_name'];
        $category->singular_name = $data['singular_name'];
        $category->parent_id = $data['parent_id'];
        $category->slug = $data['slug'];
        $category->disabled = $data['disabled'];
        return $category;
    }

    /**
     *
     * Toggling children categories.
     *
     */
    private function toggleCategoryChildren(Category $category, bool $disabled)
    {
        if($category->children) {
            foreach ($category->children as $child) {
                $child->disabled = $disabled;
                $child->save();
                $this->toggleCategoryChildren($child, $disabled);
            }
        }
    }

    /**
     *
     * Toggling parent categories.
     *
     */
    private function toggleCategoryParent(Category $category)
    {
        if($category->parent) {
            $category->parent->disabled = false;
            $category->parent->save();
            $this->toggleCategoryParent($category->parent);
        }
    }
}
