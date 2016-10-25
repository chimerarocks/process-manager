<?php

namespace App\Processes\Factories;

use App\Processes\ExampleProcess;
use App\Processes\Tasks\ExampleProcessTasks\ExampleTask;

class ExampleFactory
{
	public function make() 
	{
		$process = new ExampleProcess(
			new ExampleTask
		);
		return $process;
	}
}