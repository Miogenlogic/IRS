<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            //'name'=> 'required',
            'image'=> 'required',
            //'content'=> 'required',

        ];
    }

    public function messages()
    {
            return [
                //'name.required' => 'Field is required.',
                //'page.regex' => 'Field must consist of a-zA-Z0-9.',
                'image.required' => 'Field is required.',
                //'title.regex' => 'Field must consist of a-zA-Z0-9.',
                //'content.required' => 'Field is required.',
                 ];
    }
}
