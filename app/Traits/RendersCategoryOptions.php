<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait RendersCategoryOptions
{
    public function renderCategoryOptions(array $categories, ?int $category_id = null): string
    {
        $level = 0;
        $html = '';

        foreach ($categories as $category) {
            $selected = ($category_id !== null && $category['id'] == $category_id) ? ' selected' : '';
            $disabled = $category['disabled'] ? ' disabled' : '';

            $class = 'class="ml-' . ($level * 2) . '"';

            $html .= '<option value="' . htmlspecialchars($category['id'], ENT_QUOTES, 'UTF-8') . '" ' . $class . $disabled . $selected . '>';
            $html .= str_repeat('&nbsp;', $level * 2) . htmlspecialchars($category['plural_name'], ENT_QUOTES, 'UTF-8');
            $html .= '</option>';

            if (isset($category['children']) && is_array($category['children'])) {
                $html .= $this->renderCategoryOptions($category['children'], $category_id, $level + 1);
            }
        }

        return $html;
    }
}
