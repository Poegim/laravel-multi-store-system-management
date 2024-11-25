<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExternalInvoiceRequest extends FormRequest
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
            'invoice_number' => ['required', 'min:3', 'max:255', 'unique:external_invoices,invoice_number'],
            'store_id' => ['required', 'exists:stores,id'],
            'user_id' => ['required', 'exists:users,id'],
            'contact_id' => ['required', 'exists:contacts,id'],
            'price' => ['nullable'],
            'is_temp' => ['required', 'boolean'],
        ];
    }

        /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'store_id' => $this->route('store'),
            'user_id' => auth()->user()->id,
            'is_temp' => true,
        ]);
    }

    
}
