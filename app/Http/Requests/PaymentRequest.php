<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'transaction_id'=> 'required',
            'transaction_mode'=> 'required',
            'operator_name'=> 'required',
            'payment_status'=> 'required',
            'amount'=> 'required',
            'uncleared_amount'=> 'required',

        ];
    }

    public function messages()
    {
            return [
                'transaction_id.required' => 'Field is required.',
                'transaction_mode.required' => 'Field is required.',
                'operator_name.required' => 'Field is required.',
                'payment_status.required' => 'Field is required.',
                'amount.required' => 'Field is required.',
                'uncleared_amount.required' => 'Field is required.',
                 ];
    }
}
