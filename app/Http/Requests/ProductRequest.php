<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'p_name' => 'required',
            'p_model' => 'required',
            'price' => 'required',
            'sell_price' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'p_name' => 'Product Name',
            'p_model' => 'Model',
            'Price' => 'Price',
            'sell_price' => 'Selling Price',
        ];
    }
}
