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
            //'page'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',
           // 'title'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',
           'name'=> 'required',

            'email'=> 'required|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',
            'username'=> 'required',
            'phone' => 'min:10|numeric',
            'password'=> 'required',
            'user_type'=> 'required',
            'usercountry'=> 'required',


        ];
    }

    public function messages()
    {
            return [
                'name.required' => 'Field is required.',

                'email.required' => 'Field is required.',

                'email.regex' => 'Please enter a valid email address',
                'username.required' => 'Field is required.',
                'password.required' => 'Field is required.',
                'user_type.required' => 'Field is required.',
                'usercountry.required' => 'Field is required.',


                'phone.min' => 'Please enter 10 digit phone number',
               // 'phone.max' => 'Please enter only 10 digit phone number',
                'phone.numeric' => 'Please enter numeric phone number',
                 ];
    }
}
