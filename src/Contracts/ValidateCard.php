<?php

namespace Validate\Contracts;

interface ValidateCard
{
	/**
	 * Validate card number
	 *
	 * @param string $cardNumber
	 *
	 * @return bool
	 */
	public function validate(string $cardNumber) : bool;
}