<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'full_name' => 'Full Name',
            'email' => 'Email',
            'phone_number' => 'Phone Number'
        ];
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users,email',
            'phone_number' => 'required|unique:users,phone_number',
        ];
    }

    public function messages()
    {
        return [
            'required'=> 'The :attributes field is required',
            'email'=> 'The :attributes invalidate',
            'unique'=> 'The :attributes Already exist'
        ];
    }
}
