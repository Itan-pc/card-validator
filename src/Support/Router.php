<?php

namespace Validate\Support;

use Exception;
use Validate\Contracts\RequestInterface;
use Validate\Contracts\RouterInterface;

class Router implements RouterInterface
{
	/**
	 * Request
	 *
	 * @var RequestInterface
	 */
	private $request;

	/**
	 * Routes
	 *
	 * @var array
	 */
	private $routes = [];

	/**
	 * Router constructor.
	 *
	 * @param RequestInterface $request
	 */
	public function __construct(RequestInterface $request)
	{
		$this->request = $request;
	}

	/**
	 * Get request
	 *
	 * @return RequestInterface
	 */
	public function getRequest() : RequestInterface
	{
		return $this->request;
	}

	/**
	 * Add route
	 *
	 * @param string $uri
	 * @param array $methods
	 *
	 *
	 * @return void
	 */
	public function addRoute(string $uri, array $methods) : void
	{
		foreach ($methods as $method => $controller) {
			$method = strtoupper($method);
			if (!$this->hasRoute($uri, $method)) {
				$this->routes[$uri][$method] = $controller;
			}
		}
	}

	/**
	 * Has route
	 *
	 * @param string $uri
	 * @param string $method
	 * @return bool
	 */
	public function hasRoute(string $uri, string $method) : bool
	{
		return array_key_exists($uri, $this->routes) && isset($this->routes[$uri][$method]);
	}

	/**
	 * Run the router.
	 *
	 * @return mixed
	 */
	public function run()
	{
		if($this->hasRoute($this->request->getUri(), $this->request->getMethod())) {
			echo $this->callControllerAction($this->routes[$this->request->getUri()][$this->request->getMethod()]);
		} else {
			header("HTTP/1.1 404 Not Found");
			exit();
		}
	}


	protected function callControllerAction(string $controller)
	{
		list($className, $method) = explode('@', $controller);

		$classPath = '\Validate\\Controllers\\'.$className;

		if (!class_exists($classPath)) {
			throw new Exception("Class \"$classPath\" does not exist");
		}

		return (new $classPath)->$method($this->request);
	}
}