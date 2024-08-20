<?php

namespace App;

trait RendersCategoryOptions
{
    public function renderCategoryOptions($categories, $level = 0)
    {
        $html = '';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category['id'] . '" class="ml-' . ($level * 2) . '">';
            $html .= str_repeat('&nbsp;', $level * 2) . $category['plural_name'];
            $html .= '</option>';
            if (array_key_exists('children', $category)) {
                $html .= $this->renderCategoryOptions($category['children'], $level + 1);
            }
        }
        return $html;
    }
}
