<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BackDateEditRequest extends FormRequest
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
            'days'=>'required|regex:/^[0-9]*$/',
        ];
    }

    public function messages()
    {
        return [
            'days.required' => 'Field is required.',
            'days.regex' => 'Field must be positive integer.',
        ];
    }
}
