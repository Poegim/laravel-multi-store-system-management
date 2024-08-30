<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFeatureRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:2',
                'max:20',
                Rule::unique('features', 'name')->ignore($this->feature, 'slug'),
            ],
            'short_name' => [
                'nullable',
                'string',
                'min:2',
                'max:6',
                Rule::unique('features', 'short_name')->ignore($this->feature, 'slug'),
            ],
            'slug' => [
                'required',
                'string',
                'min:2',
                'max:20',
                Rule::unique('features', 'slug')->ignore($this->feature, 'slug'),
            ],
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
