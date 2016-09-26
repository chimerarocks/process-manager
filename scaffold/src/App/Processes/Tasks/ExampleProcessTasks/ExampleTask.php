<?php

namespace App\Processes\Tasks\ExampleProcessTasks;

use ProcessManager\Processes\TaskInterface;

class ExampleTask implements TaskInterface
{
	public function execute(array $args)
	{
		return ["data"];
	}
}