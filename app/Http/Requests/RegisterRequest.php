<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'=> 'required',
            //'featured'=> 'required',
            //'title'=> 'required',
            'email'=> 'required|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',

            'phone' => 'min:10|numeric',
             'country_id'=> 'required',

        ];
    }

    public function messages()
    {
            return [
                'name.required' => 'Field is required.',
                //'page.regex' => 'Field must consist of a-zA-Z0-9.',
                //'title.required' => 'Field is required.',
                //'title.regex' => 'Field must consist of a-zA-Z0-9.',
                'email.required' => 'Field is required.',

                'email.regex' => 'Please enter a valid email address',
                'phone.min' => 'Please enter 10 digit phone number',
                // 'phone.max' => 'Please enter only 10 digit phone number',
                'phone.numeric' => 'Please enter numeric phone number',

                'country_id.required' => 'Field is required.',


                 ];
    }
}
