<?php



namespace App\Http\Requests;



use Illuminate\Foundation\Http\FormRequest;



class Myform extends FormRequest

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
           'password'=>'required|min:6',
            'password_confirmation'=>'required_with:password|same:password',

            
            //'page'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',

           // 'title'=> 'required|regex:/^[a-zA-Z0-9\-]+( [a-zA-Z0-9\-\s]+)*$/',

           // 'content'=> 'required',



        ];

    }



    public function messages()

    {

            return [

                'password.required' => 'Field is required.',
                'password.min' => 'Field must be minimum 6 charecters',
                'password_confirmation.same' => 'Field must be same as password',
                'password_confirmation.required' => 'Field is required.',

                //'password_confirmation.regex' => '.',

                // 'regisnumber.required' => 'Field is required.',
                // 'regisnumber.regex' => 'Field must consist of a-zA-Z0-9.',
                // 'email.required'  => 'A email is required',
                // 'title.regex' => 'Field must consist of a-zA-Z0-9.',

                //'content.required' => 'Field is required.',

                 ];

    }

}

