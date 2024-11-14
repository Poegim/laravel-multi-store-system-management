<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => 'required|min:2|max:255',
            'surname' => 'min:2|max:255|nullable',
            'identification_number' => 'required_if:type,2|nullable|unique:contacts,identification_number|min:2|max:30',
            'type' => 'required|integer|min:1|max:2',
            'country' => 'min:3|max:60|nullable',
            'city' => 'min:3|max:60|nullable',
            'postcode' => 'string|min:5|max:5|nullable',
            'street' => 'string|min:2|max:255|nullable',
            'building_number' => 'string|min:1|max:30|nullable',
            'apartment_number' => 'string|min:1|max:30|nullable',
            'email' => 'email|nullable',
            'phone' => 'string|min:6|max:30|nullable',
            'second_phone' => 'string|min:6|max:30|nullable',
            'www' => 'string|min:6|max:255|nullable',
            'description' => 'string|min:1|max:255|nullable',
        ];
    }

    public function messages()
    {
        return [
            'identification_number.required_if' => 'The identification number field is required when contact type is company.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if($this->input('type') == 2) {
            $this->merge([
                'surname' => '',
            ]);
        }

    }
}
