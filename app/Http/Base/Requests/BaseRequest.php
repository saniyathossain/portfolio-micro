<?php

namespace App\Http\Base\Requests;
use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	abstract public function authorize(): bool;

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	abstract public function rules(): array;
}
