<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
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
			'email'=>'required|email:filter,dns|exists:users,email'

		];
	}
	public function messages(){
		return[
			'email.required'=>'Input :attribute.',
			'email.email'=>'Input valid email.',
			'email.exists'=>'Input registered :attribute.',
		];
	}

	public function attributes(){
		return[
			'email'=>'email address',
		];
	}
}
