<?php

namespace Validate\Controllers;

abstract class Controller
{
	public function jsonResponse($data, $code = 200)
	{
    	header_remove();
    	http_response_code($code);
		header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
		header('Content-Type: application/json');

		return json_encode(array(
			'status' => $code,
			'data' => $data
		), JSON_THROW_ON_ERROR);
	}
}