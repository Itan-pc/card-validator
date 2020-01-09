<?php

namespace Validate\Support;

use Validate\Contracts\RequestInterface;

class Request implements RequestInterface
{
	/**
	 * Uri
	 *
	 * @var string
	 */
	private $uri;

	/**
	 * Method
	 *
	 * @var string
	 */
	private $method;

	/**
	 * Request params
	 *
	 * @var array
	 */
	private $params;

	/**
	 * Request constructor.
	 *
	 * @param string $uri
	 * @param string $method
	 * @param array $params
	 */
	public function __construct(string $uri, string $method, array $params = [])
	{
		$this->uri = $uri;
		$this->method = $method;
		$this->params = $params;
	}

	/**
	 * Get uri
	 *
	 * @return string
	 */
	public function getUri() : string
	{
		return $this->uri;
	}

	/**
	 * Get method
	 *
	 * @return string
	 */
	public function getMethod() : string
	{
		return $this->method;
	}

	/**
	 * Get request params
	 *
	 * @return array
	 */
	public function getParams() : array
	{
		return $this->params;
	}

	/**
	 * Get request param by "key"
	 *
	 * @param $key
	 *
	 * @param null $default
	 * @return mixed|null
	 */
	public function getParam($key, $default = null)
	{
		return $this->params[$key] ?? $default;
	}

	/**
	 * Has param
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public function hasParam($key) : bool
	{
		return array_key_exists($key, $this->params);
	}

	/**
	 * Is empty param
	 *
	 * @param $key
	 * @return bool
	 */
	public function isEmptyParam($key) : bool
	{
		return empty($this->getParam($key));
	}
}