<?php

namespace ProcessManager\Processes\InputReader;

use ProcessManager\Processes\InputReader\InputReader;

class HttpInputReader extends InputReader
{

	private $route;

	private $method;

	private $request;

	private $query;

	public function __construct($args) 
	{
		parent::__construct($args);
		$route = $_SERVER['REDIRECT_URL'] ?? $_SERVER['REQUEST_URI'];
		$this->query = $_SERVER['QUERY_STRING'];
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->request = $args['_'.$this->method];
		if (!empty(BASE_URI)) {
			$test = str_replace('/', '\/', rtrim(BASE_URI, '/') . '/');
			preg_match('/\/' . $test . '(.*?)\/?$/', $route, $matches);
			if (!isset($matches[1])) {
				throw new \Exception("Sua configuração para BASE_URI não pode ser encontrada na url.", 1);
			}
			$this->route = $matches[1];
		} else {
			$this->route = '';
		}
	}

	public function getParams()
	{
		return $this->request;
	}

	public function getProcessName()
	{
		return $this->route;
	}
	
	public function setRunEnvironment()
	{
		define("RUN_ENV", "http");
	}
}