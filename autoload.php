<?php

spl_autoload_register(function ($class) {

	$prefix = 'Validate\\';
	if (0 !== strpos($class, $prefix)) {
		return;
	}

	$file = __DIR__.'/src/'.str_replace('\\', '/', substr($class, strlen($prefix))).'.php';
	if (!is_readable($file)) {
		return;
	}

	require $file;
});