<?php

namespace App\Processes;

use ProcessManager\Processes\Process;
use ProcessManager\Processes\TaskInterface;
use ProcessManager\Response;

class ExampleProcess extends Process
{
	private $scriptTask;

	public function __construct(TaskInterface $scriptTask)
	{
		$this->scriptTask = $scriptTask;
	}

	public function start() 
	{
		$data = $this->scriptTask->execute([]);

		logIt($this->logMessage("processexecuted"));

		return new Response($data);
	}

	private function logMessage($message)
	{
		$logMessage = [
			"data" => [
				"field1" => $this->field1,
				"field2" => $this->field2,
			]
		];

		return json_encode($logMessage);
	}
}