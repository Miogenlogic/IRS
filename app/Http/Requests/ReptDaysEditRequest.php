<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReptDaysEditRequest extends FormRequest
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
            'emp_days'=>'required|regex:/^[0-9]*$/',
            'rm_days'=>'required|regex:/^[0-9]*$/',
            'sh_days'=>'required|regex:/^[0-9]*$/',
        ];
    }

    public function messages()
    {
        return [
            'emp_days.required' => 'Field is required.',
            'emp_days.regex' => 'Field must be positive integer.',
			'rm_days.required' => 'Field is required.',
            'rm_days.regex' => 'Field must be positive integer.',
			'sh_days.required' => 'Field is required.',
            'sh_days.regex' => 'Field must be positive integer.',
            'md_desk_email.required' => 'Field is required.',
            'safety_id.required' => 'Field is required.',
        ];
    }
}
