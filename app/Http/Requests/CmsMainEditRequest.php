<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CmsMainEditRequest extends FormRequest
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
           // 'page'=> 'required',
            //'title'=> 'required',
            'seo_url'=> 'required|unique:cms_main,seo_url,'.$this->id.',id',

            //'seo_url'=> 'required|unique:workshop,seo_url',
            //'menu'=> 'required'




        ];
    }

    public function messages()
    {
            return [
               // 'page.required' => 'Field is required.',
                //'title.required' => 'Field is required.',
                'seo_url.required' => 'Field will be unique.',
                //'menu'=> 'Field is required.'
                 ];
    }
}
