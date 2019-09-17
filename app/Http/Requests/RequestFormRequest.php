<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestFormRequest extends FormRequest
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
           // 'content'=> 'required',

        ];
    }

    public function messages()
    {
            return [
                'page.required' => 'Field is required.',
                'page.regex' => 'Field must consist of a-zA-Z0-9.',
                'title.required' => 'Field is required.',
                'title.regex' => 'Field must consist of a-zA-Z0-9.',
                //'content.required' => 'Field is required.',
                 ];
    }
}
