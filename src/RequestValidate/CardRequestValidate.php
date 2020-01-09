<?php

namespace Validate\RequestValidate;

class CardRequestValidate extends RequestValidate
{
	public function rules(): array
	{
		return [
			'cardholder' => 'required',
			'cardnumber' => 'required'
		];
	}
}