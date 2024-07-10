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
        $this->toggleCategoryChildren($category, $category->disabled);

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

    public function toggleCategoryChildren(Category $category, bool $disabled)
    {
        if($category->children) {
            foreach ($category->children as $child) {
                $child->disabled = $disabled;
                $child->save();
                $this->toggleCategoryChildren($child, $disabled);
            }
        }
    }
}