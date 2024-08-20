<?php

namespace App\Repositories\CategoryRepository ;

use App\Models\Warehouse\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function store(array $data)
    {
        $category = new Category;
        $category = $this->associate($category, $data);
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

        return $category->save();
    }

    /**
     *
     * Returns tree of active categories.
     *
     */
    public function activeTree()
    {

        Cache::forget('categories_tree');

        //Get enabled categories and build tree.
        $categoryTree = Cache::remember('categories_tree', 60, function () {
            $categories = DB::table('categories')->where('disabled', 0)->get()->map(function ($category) {
                return (array) $category;
            })->all();

            return $this->buildTree($categories);
        });

        return $categoryTree;
    }

    /**
     *
     * Returns tree of all categories.
     *
     */
    public function allTree()
    {
        Cache::forget('categories_tree');

        //Get all categories and build tree.
        $categoryTree = Cache::remember('categories_tree', 60, function () {
            $categories = DB::table('categories')->get()->map(function ($category) {
                return (array) $category;
            })->all();

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
