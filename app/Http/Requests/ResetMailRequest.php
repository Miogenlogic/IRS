<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetMailRequest extends FormRequest
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


            'email'=> 'required|regex:/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/',


        ];
    }

    public function messages()
    {
            return [


                'email.required' => 'Field is required.',

                'email.regex' => 'Please enter a valid email address',



                 ];
    }
}
