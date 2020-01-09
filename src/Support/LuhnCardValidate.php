<?php

namespace Validate\Support;

use Validate\Contracts\ValidateCard;

class LuhnCardValidate implements ValidateCard
{
	/**
	 * Validate card number
	 *
	 * @param string $cardNumber
	 *
	 * @return bool
	 */
	public function validate(string $cardNumber) : bool
	{
		$number = strrev(preg_replace('/[^\d]/', '', $cardNumber));

		if (empty($number)) {
			return false;
		}

		$sum = 0;
		for ($i = 0, $j = strlen($number); $i < $j; $i++) {
			if (($i % 2) == 0) {
				$val = $number[$i];
			} else {
				$val = $number[$i] * 2;
				if ($val > 9)  {
					$val -= 9;
				}
			}
			$sum += $val;
		}
		return (($sum % 10) === 0);
	}
}