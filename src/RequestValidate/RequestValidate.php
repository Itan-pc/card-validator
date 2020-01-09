<?php

namespace Validate\RequestValidate;

use Validate\Contracts\RequestInterface;

abstract class RequestValidate
{
	/**
	 * Request
	 *
	 * @var RequestInterface
	 */
	protected $request;

	/**
	 * Validate errors
	 *
	 * @var array
	 */
	private $errors = [];

	/**
	 * Validate rules
	 *
	 * @return array
	 */
	abstract public function rules() : array;

	/**
	 * RequestValidate constructor.
	 *
	 * @param RequestInterface $request
	 */
	public function __construct(RequestInterface $request)
	{
		$this->request = $request;
	}

	/**
	 * Validate request params
	 *
	 * @return bool
	 */
	public function validate() : bool
	{
		foreach ($this->rules() as $key => $rule) {
			if (method_exists($this, $rule)) {
				$this->$rule($key);
			}
		}

		return count($this->errors) === 0;
	}

	/**
	 * Get validate errors
	 *
	 * @return array
	 */
	public function getErrors() : array
	{
		return $this->errors;
	}

	/**
	 * Required rules
	 *
	 * @param $key
	 */
	public function required($key) : void
	{
		if ($this->request->isEmptyParam($key)) {
			$this->addError($key, "Field '$key' is required");
		}
	}

	/**
	 * Add error
	 *
	 * @param $field
	 * @param string $message
	 * @return void
	 */
	protected function addError($field, string $message) : void
	{
		$this->errors[$field] = $message;
	}
}