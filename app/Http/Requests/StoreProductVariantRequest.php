<?php

namespace App\Http\Requests;

use App\Models\Warehouse\Feature;
use App\Models\Warehouse\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductVariantRequest extends FormRequest
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
            ],
            'ean' => [
                'string', 'max:255', 'min:2', 'nullable',
            ],
            'product_id' => ['exists:products,id', 'required'],
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
        dd($this->request);
    }

    public function generateName()
    {
        $name = '';

        if($this->input('devices')) {
            foreach($this->input('devices') as $deviceId)
            {
                $device = Product::where('id', $deviceId)->with('brand')->first();
                $name = $name . $device->brand->name . ' ' . $device->name . ' ';
            }
        }
        
        if($this->input('features')) {
            foreach($this->input('features') as $featureId)
            {
                $feature = Feature::where('id', $featureId)->first();
                $name = $name . $feature->name . ' '; 
            }
        }

        //cut last space and return name
        return substr($name, 0, -1);
    }
}
