<?php

namespace ProcessManager\Processes\InputReader;

use ProcessManager\Processes\InputReader\InputReader;

class CliInputReader extends InputReader
{
	public function getParams()
	{
		$params = [];

		foreach ($this->args as $key) {
			$explode = explode(":",$key);
			if (isset($explode[1]))
				$params[$explode[0]] = $explode[1];

		}

		return $params;
	}

	public function getProcessName()
	{
		return isset($this->args[1]) ? $this->args[1] : "";
	}
	
	public function setRunEnvironment()
	{
		define("RUN_ENV", "cli");
	}
}