<?php

namespace App\Traits;

trait BuildTree
{
    protected function buildTree(array $categories, $parentId = null) {
        
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
}
