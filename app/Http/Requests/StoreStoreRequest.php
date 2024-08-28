<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreStoreRequest extends FormRequest
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

        $rules = [
            'name' => [
                'required', 
                'min:3',
                'max:255',
                Rule::unique('stores'),
            ],
            'color_id' => [
                'exists:colors,id',
                Rule::unique('stores'),
            ],
            'invoices_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],
            'margin_invoices_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],
            'proforma_invoices_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],
            'internal_servicing_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],
            'external_servicing_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],
            'contracts_prefix' => [
                'required',
                'max:30',
                'min:1',
                Rule::unique('stores'),
            ],

            'email' => [
               'required', 
               'email',
            ],
            'order' => 'required|numeric|min:1',
            'phone' => 'required|numeric|min_digits:1|max_digits:20',
            'city' => 'required|min:2|max:255',
            'postcode' => 'required|numeric|max_digits:5|min_digits:5',
            'street' => 'max:255',
            'building_number' => 'max_digits:255',
            'apartment_number' => 'max_digits:255',
            'next_receipt_number' => 'required|numeric|min:1',
            'next_invoice_number' => 'required|numeric|min:1',
            'next_margin_invoice_number' => 'required|numeric|min:1',
            'next_proforma_invoice_number' => 'required|numeric|min:1',
            'next_internal_servicing_number' => 'required|numeric|min:1',
            'next_external_servicing_number' => 'required|numeric|min:1',
            'description' => 'max:2000',
        ];


        return $rules;
    }
}
