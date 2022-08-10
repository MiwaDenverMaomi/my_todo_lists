<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        'name' =>'required | string |max:255',
        'title'=>'nullable| string |max:255',
        'email' =>'required | email | max:255',
        'comment'=>'required | string | max:1000',
        ];
    }

     public function messages()
    {
        return [
        'name.required' =>'Input required.',
        'name.string' =>'Input string.',
        'name.max' =>'Input less than 255 letters.',

        'title.string'=>'Input string.',
        'title.max'=>'Input less than 255 letters.',

        'email.required' =>'Input required.',
        'email.email' =>'Input valid email address.',
        'email.max' =>'Input less than 255 letters.',

        'comment.required'=>'Input required.',
        'comment.string'=>'Input string.',
        'comment.max'=>'Input less than 1000 letters.',
        ];
    }
}
