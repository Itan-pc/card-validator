<?php

namespace Validate\Support;

use Validate\Contracts\RouterInterface;
use Exception;

class RoutesLoader
{
	/**
	 * Router
	 *
	 * @var RouterInterface
	 */
	private $router;

	/**
	 * RoutesLoader constructor.
	 *
	 * @param RouterInterface $router
	 * @throws Exception
	 */
	public function __construct(RouterInterface $router)
	{
		$this->router = $router;
		$this->loadRoutesFile();
	}

	/**
	 * Load routes file
	 *
	 * @return void
	 * @throws Exception
	 */
	public function loadRoutesFile() : void
	{
		$routes = require ($this->getRoutesFile());

		foreach ($routes as $uri => $options) {
			$this->router->addRoute($uri, $options['methods']);
		}
	}

	/**
	 * Get routes file
	 *
	 * @return string
	 * @throws Exception
	 */
	public function getRoutesFile() : string
	{
		$file = realpath(dirname(__DIR__, 2)).'/routes.php';

		if (!file_exists($file)) {
			throw new Exception('File routes.php does not exist.');
		}

		return $file;
	}
}