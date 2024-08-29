<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:2','max:255',],
            'slug' =>
            [
                'required',
                'string',
                'min:2',
                'max:255',
                // Rule::unique('products')->where('brand_id', $this->input('brand_id'))->ignore($this->id)
                Rule::unique('products')->ignore($this->id)
            ],
            'is_device' => ['required', 'boolean'],
            // 'brand_id' => ['required', 'exists:App\Models\Warehouse\Brand,id'],
            'category_id' => ['required', 'exists:App\Models\Warehouse\Category,id'],
        ];
    }

    public function messages()
    {
        return [
            'slug.unique' => 'The combination of name and brand must be unique.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => Str::slug($this->name),
        ]);
    }
}
