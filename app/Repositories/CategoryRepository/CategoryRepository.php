<?php

namespace App\Repositories\CategoryRepository ;

use App\Models\Warehouse\Category;

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

    private function associate(Category $category, $data)
    {
        $category->plural_name = $data['plural_name'];
        $category->singular_name = $data['singular_name'];
        $category->parent_id = $data['parent_id'];
        $category->slug = $data['slug'];
        $category->disabled = $data['disabled'];
        return $category;
    }

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

    private function toggleCategoryParent(Category $category)
    {
        if($category->parent) {
            $category->parent->disabled = false;
            $category->parent->save();
            $this->toggleCategoryParent($category->parent);
        }
    }
}
