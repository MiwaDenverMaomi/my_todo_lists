<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\TokenExpirationTimeRule;

class ResetPasswordRequest extends FormRequest
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
			'password'=>['required', 'between:8,255','regex:/\A(?=.*?[a-z])(?=.*?\d)(?=.*?[!-\/:-@[-`{-~])[!-~]+\z/i', 'confirmed'],
			'password_confirmation' => 'required | same:password',
			'reset_token'=>['required',new TokenExpirationTimeRule]
		];
	}
	/**
	 *
	 * @return array
	 */
	public function messages(){
		return[
			'password.required'=>'Input required.',
			'password.regex'=>'Input :attribute within 8-255 letters with alphabets,numbers and symbols.',
			'password.confirmed'=>':attributes do not match.'
		];
	}
	/**
	 *
	 * @return array
	 */
	public function attributes(){
		return  [
			'password'=>'password'
		];
	}
}
