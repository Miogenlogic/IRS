<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileEditRequest extends FormRequest
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
            'email'=> 'required',
            'country'=> 'required',
            'city'=> 'required',

        ];
    }

    public function messages()
    {
            return [
                'name.required' => 'Field is required.',
                'email.required' => 'Field is required.',
                'country.required' => 'Field is required.',
                'city.required' => 'Field is required.',
                 ];
    }
}
