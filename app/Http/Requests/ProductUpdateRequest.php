<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
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
            'title' => 'required | min:3 | max:255 ',
            'description' => ' min:3 | max:1250 | nullable',
            'image' => 'image | nullable | max:2048 |mimes:jpg,png,jpeg ',
            'image2' => 'image | nullable | max:1024 |mimes:jpg,png,jpeg ',
            'image3' => 'image | nullable | max:1024 |mimes:jpg,png,jpeg ',
            'price' => 'required | min:1',
            'discounted_price' => 'nullable | min:1',
            'discount_rate' => 'nullable | min:1',
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
            'discounted_price' => 'Product Discounted Price',
            'discount_rate' => 'Product Discounted Rate',

        ];
    }
}
