<?php

namespace ProcessManager\Processes;

use ProcessManager\Processes\Process;
use ProcessManager\Response;

abstract class AbstractObserverProcess extends Process
{
	public $sleep;

	public function start() 
	{
		echo "Processo iniciado";
		while (true) {
			$entity = $this->getObservableEntity();
			$property = $this->getObservableProperty($entity);
			if ($this->shouldDispatch($property)) {
				$this->dispatch();
				if ($this->haveToDie()) {
					die();
				}
			}
			sleep($this->sleep);
		}
		echo('processo terminado');

		return new Response('finished');
	}

	abstract protected function getObservableEntity();

	abstract protected function getObservableProperty($entity);

	abstract protected function shouldDispatch($property);

	abstract protected function dispatch();

	abstract protected function haveToDie();
}