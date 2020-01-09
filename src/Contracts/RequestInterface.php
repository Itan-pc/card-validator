<?php

namespace Validate\Contracts;

interface RequestInterface
{
	/**
	 * Get uri
	 *
	 * @return string
	 */
	public function getUri() : string;

	/**
	 * Get method
	 *
	 * @return string
	 */
	public function getMethod() : string;

	/**
	 * Get request params
	 *
	 * @return array
	 */
	public function getParams() : array;

	/**
	 * Get request param by "key"
	 *
	 * @param $key
	 *
	 * @param null $default
	 * @return mixed|null
	 */
	public function getParam($key, $default = null);

	/**
	 * Has param
	 *
	 * @param $key
	 *
	 * @return bool
	 */
	public function hasParam($key) : bool;

	/**
	 * Is empty param
	 *
	 * @param $key
	 * @return bool
	 */
	public function isEmptyParam($key) : bool;
}