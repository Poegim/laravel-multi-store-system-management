<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductVariantRequest extends FormRequest
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
                'required', 'string', 'max:255', 'min:2',
            ],
            'slug' => [
                'required', 'string', 'max:255', 'min:2', 
                Rule::unique('product_variants')->where(function ($query) {
                    return $query->where('product_id', $this->input('product_id'));
                })->ignore($this->route('product_variant')),
            ],
            'ean' => [
                'string', 'max:255', 'min:2', 'nullable',
            ],
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'devices' => ['array', 'nullable'],
            'devices.*' => ['exists:products,id'],
            'features' => ['nullable', 'array'],
            'features.*' => ['exists:products,id'],
            'suggested_retail_price' => ['numeric', 'min:0.01', 'nullable'],
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'devices' => json_decode($this->input('devices'), true),
        ]);

        if(!$this->input('name')) {
            $this->merge([
                'name' => $this->generateName(),
            ]);
        }

        if($this->input('name')) {
            $this->merge([
                'slug' => Str::slug($this->input('name')),
            ]);
        }
    }

    /**
     * Merging selected feature and device names and return as string.
     *
     * @return string
     */
    public function generateName(): string
    {
        $name = '';

        if(is_array($this->input('devices'))) {
            foreach($this->input('devices') as $deviceId)
            {
                $device = Product::where('id', $deviceId)->with('brand')->first();
                if($device) {
                    $name = $name . $device->brand->name . ' ' . $device->name . ' ';
                }
            }
        }
        
        if($this->input('features')) {
            foreach($this->input('features') as $featureId)
            {
                $feature = Feature::where('id', $featureId)->first();
                $name = $name . $feature->name . ' '; 
            }
        }

        //Cut last space and return name
        return Str::limit(substr($name, 0, -1), 255);
    }

    public function messages()
    {
        return [
            'slug.unique' => 'This combination of name and product already exist.',
        ];
    }
}
