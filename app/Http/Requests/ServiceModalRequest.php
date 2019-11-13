<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceModalRequest extends FormRequest
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
            'model_name'=> 'required|unique:service_model,model_name',
            'model_title'=> 'required',
            'service_id'=> 'required',

        ];
    }

    public function messages()
    {
            return [

                'model_name.required' => 'Field is required.',
                'model_name.unique' => 'Field will be unique.',

                'model_title.required' => 'Field is required.',
                'service_id.required' => 'Field is required.',


                 ];
    }
}
