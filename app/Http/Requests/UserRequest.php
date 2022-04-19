<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_name' => 'required',
            'user_phone' => 'required',
            'user_email' => 'required',
            'user_password' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'user_name' => 'User Name',
            'user_phone' => 'User Phone Number',
            'user_email' => 'User Email Address',
            'user_password' => 'Password',
        ];
    }
}
