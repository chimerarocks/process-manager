<?php

namespace ProcessManager\Processes;

use ProcessManager\Response;
use ProcessManager\Processes\ProcessInterface;
use ProcessManager\Processes\InputReader\InputReader;

abstract class Process
{
	public function setReader(InputReader $reader)
	{
		$this->reader = $reader;
	}

	public function initProcess()
	{
		if (empty($this->reader)) {
			throw new \Exception("Process Manager Error: Reader is not setted", 1);
		}

		$params = $this->reader->getParams();
		
		foreach ($this->options() as $key => $value) {
			$this->$key = isset($params[$key]) ? $params[$key] : "";
		}
	}

	public function help() 
	{
		$string = "";
		foreach ($this->options() as $key => $value) {
			$string .= "[$key] ";
		}
		return new Response(["success" => true, "params" => $string]);
	}

	private function options() 
	{
		return get_class_vars(get_class($this));
	}

	abstract public function start();

}