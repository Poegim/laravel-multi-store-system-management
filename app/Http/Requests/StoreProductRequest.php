<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use App\Models\Warehouse\Brand;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string','min:2','max:255',],
            'slug' => ['required', 'string','min:2','max:255', Rule::unique('products')],
            'is_device' => ['required', 'boolean'],
            // 'brand_id' => ['required', 'exists:App\Models\Warehouse\Brand,id'],
            'category_id' => ['required', 'exists:App\Models\Warehouse\Category,id'],
        ];
    }

    // public function messages()
    // {
    //     return [
    //         'slug.unique' => 'The combination of name and brand must be unique.',
    //     ];
    // }

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
