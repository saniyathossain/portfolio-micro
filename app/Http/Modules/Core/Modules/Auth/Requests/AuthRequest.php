<?php

namespace App\Http\Modules\Auth\Requests;

use App\Http\Base\Requests\BaseRequest;

class AuthRequest extends BaseRequest
{
	/**
	* Determine if the user is authorized to make this request.
	*
	* @return bool
	*/
	public function authorize(): bool
	{
		return true;
	}

	/**
	* Get the validation rules that apply to the request.
	*
	* @return array
	*/
	public function rules(): array
	{
		return [
			'username'	=> 'required',
			'password'	=> 'required'
		];
	}
}