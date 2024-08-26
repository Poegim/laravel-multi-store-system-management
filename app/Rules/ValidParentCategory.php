<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidParentCategory implements ValidationRule
{
    protected ?int $currentCategoryId;

    /**
     * Create a new rule instance.
     *
     * @param int|null $currentCategoryId
     * @return void
     */
    public function __construct(?int $currentCategoryId = null)
    {
        $this->currentCategoryId = $currentCategoryId;
    }

    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  Closure  $fail
     * @return void
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value == $this->currentCategoryId) {
            $fail('The selected category cannot be its own parent.');
            return;
        }

        if ($this->isDescendant($value, $this->currentCategoryId)) {
            $fail('The selected category cannot be a child of itself or its descendants.');
        }
    }

    /**
     * Check if a category is a descendant of another category.
     *
     * @param int $parentId
     * @param int|null $categoryId
     * @return bool
     */
    protected function isDescendant(int $parentId, ?int $categoryId): bool
    {
        if ($categoryId === null) {
            return false;
        }

        $descendants = $this->getDescendants($categoryId);
        return in_array($parentId, $descendants, true);
    }

    /**
     * Get all descendants of a category.
     *
     * @param int $categoryId
     * @return array
     */
    protected function getDescendants(int $categoryId): array
    {
        $descendants = [];
        $categories = DB::table('categories')->where('parent_id', $categoryId)->get();

        foreach ($categories as $category) {
            $descendants[] = $category->id;
            $descendants = array_merge($descendants, $this->getDescendants($category->id));
        }

        return $descendants;
    }

}
