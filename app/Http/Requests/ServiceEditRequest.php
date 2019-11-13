<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceEditRequest extends FormRequest
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

            //'featured'=> 'required',
            'title'=> 'required',
            'seo_url'=> 'required|unique:service,seo_url,'.$this->id.',id',

        ];
    }

    public function messages()
    {
            return [
                //'featured.required' => 'Field is required.',
                //'page.regex' => 'Field must consist of a-zA-Z0-9.',
                'title.required' => 'Field is required.',
                //'title.regex' => 'Field must consist of a-zA-Z0-9.',
                'seo_url.required' => 'Field will be unique.',
                 ];
    }
}
