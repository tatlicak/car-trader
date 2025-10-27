<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
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
           'maker_id' => 'required|exists:makers,id',
            'model_id' => 'required|exits:models,id',
            'year' => 'required|integer|min:1970|max:' . date('Y'),
            'phone'=>'required|string|min:10',
            'price' => 'required|integer|min:0',
            'vin' => 'required|string|max:17',
            'mileage' => 'required|integer|min:0',
            'car_type_id' => 'required|exists:car_types,id',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'city_id' => 'required|exists:cities,id',
            'address' => 'required|string',
            'description' => 'nullable|string',
            'features'=>'array',
            'features.*'=>'string',
            //'phone'=> new Phone(),
            'published_at' => 'nullable|date',
            'images' => 'array',
            //'images.*'=>'image|mimes:jpeg,jpg,png,webp,gif|max:2408',
            'images.*'=> File::image()->max(2)
        ];

      
}
  public function messages(): array
        {
            return ['required' => 'This :attribute is required.'];
    }

public function attributes(): array
        {
            return [
                'maker_id' => 'Maker',
                'model_id' => 'Model',
                'year' => 'Year',
                'phone' => 'Phone',
                'price' => 'Price',
                'vin' => 'VIN',
                'mileage' => 'Mileage',
                'car_type_id' => 'Car Type',
                'fuel_type_id' => 'Fuel Type',
                'city_id' => 'City',
                'address' => 'Address',
                'description' => 'Description',
                'features'=>'Features',
                'published_at' => 'Published At',
                'images' => 'Images'
            ];
        }

}
