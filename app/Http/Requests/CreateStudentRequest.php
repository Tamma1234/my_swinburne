<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'phone_number' => 'Phone Number',
            'province_id' => 'Province',
            'district_id' => 'District',
            'ward_id' => 'Ward',
            'address' => 'Address'
        ];
    }

    public function rules()
    {
        return [
            'full_name' => 'required',
            'email' => 'required|email:rfc,dns|unique:student_user,email',
            'phone_number' => 'required|unique:student_user,phone_number',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'address' => 'required',
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
