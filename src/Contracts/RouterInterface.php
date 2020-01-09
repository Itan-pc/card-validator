<?php

namespace Validate\Contracts;

interface RouterInterface
{
	/**
	 * Add route
	 *
	 * @param string $uri
	 * @param array $methods
	 *
	 *
	 * @return void
	 */
	public function addRoute(string $uri, array $methods) : void;

	/**
	 * Has route
	 *
	 * @param string $uri
	 * @param string $method
	 * @return bool
	 */
	public function hasRoute(string $uri, string $method) : bool;

	/**
	 * Get request
	 *
	 * @return RequestInterface
	 */
	public function getRequest() : RequestInterface;
}