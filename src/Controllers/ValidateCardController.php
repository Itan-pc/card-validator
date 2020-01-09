<?php

namespace Validate\Controllers;

use Validate\Contracts\RequestInterface;
use Validate\Support\LuhnCardValidate;
use Validate\RequestValidate\CardRequestValidate;

class ValidateCardController extends Controller
{
	/**
	 * Validate card
	 *
	 * @param RequestInterface $request
	 * @return string
	 */
	public function validate(RequestInterface $request) : string
	{
		$validator = new CardRequestValidate($request);

		if (!$validator->validate()) {
			return $this->jsonResponse(422, ['errors' => $validator->getErrors()]);
		}

		$cardValidate = new LuhnCardValidate();
		$cardNumber = $request->getParam('cardnumber');

		if ($cardValidate->validate($cardNumber)) {
			return $this->jsonResponse(200, ['message' => "Card number \"$cardNumber\" is valid"]);
		}

		return $this->jsonResponse(200, ['message' => "Card number \"$cardNumber\" is invalid"]);
	}
}