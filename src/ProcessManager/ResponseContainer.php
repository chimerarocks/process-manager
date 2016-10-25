<?php

namespace ProcessManager;

use ProcessManager\Response;
use Zend\Diactoros\Response\JsonResponse;

class ResponseContainer
{
	public static function send($response)
	{
		if (! $response instanceof Response)
		{
			throw new \Exception("All Processes must returns a 'ProcessManager\Response' but this process returned" . print_r($response) , 1);
		}
		if (RUN_ENV == 'http') {
			return new JsonResponse($response->getData(), $response->getStatus(), $response->getHeaders());
		} else if (RUN_ENV == 'cli') {
			return $response->dataArray();
		}
	}
}