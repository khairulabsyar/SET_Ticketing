<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreuserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * 
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'password' => [
                'required',
                'string',
                'alpha_num',
                'min:5'
            ],
            'role' => 'required|string|max:255',
            'email' => 'required|string|unique:posts|max:255',

        ];
    }

    public function messages()
    {
        return [
            'name.string' => "Hey, your name is not available",
            'password.string' => "The password must consist of string and alpha numeric",
            'role.string' => "Role is not available",
            'email.string' => "Email has been taken",
        ];
    }
}