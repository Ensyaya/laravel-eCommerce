<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required | unique:App\Models\Product,title| min:3 | max:255 ',
            'description' => ' min:3 | max:1250 | nullable',
            'image' => 'image | required | max:1024 |mimes:jpg,png,jpeg ',
            'image2' => 'image | nullable | max:1024 |mimes:jpg,png,jpeg ',
            'image3' => 'image | nullable | max:1024 |mimes:jpg,png,jpeg ',
            'price' => 'required | min:1',
        ];
    }
    public function attributes()
    {
        return [
            'title' => 'Product Title',
            'description' => 'Product Descriprion',
            'image' => 'Product First Image',
            'image2' => 'Product Second Image',
            'image3' => 'Product Third Image',
            'price' => 'Product Price',
        ];
    }
}
