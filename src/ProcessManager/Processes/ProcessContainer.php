<?php

namespace ProcessManager\Processes;

use ProcessManager\Processes\InputReader\InputReader;
use ProcessManager\Processes\NullProcess;
use ProcessManager\Response;
use ProcessManager\ResponseContainer;
use Zend\Diactoros\Response\JsonResponse;

abstract class ProcessContainer
{

	private $process;
	private $reader;

	abstract protected function bind();
	abstract protected function factories();

	public function route(InputReader $reader)
	{
		$this->reader = $reader;
		$this->initProcess();
		return $this;
	}

	public function run()
	{
		if ($this->needsParams($this->process) && null == $this->reader->getParams())
			return ResponseContainer::send($this->process->help());
		else {
			try { 
				return ResponseContainer::send($this->process->start());
			} catch (\Exception $e) {
				return ResponseContainer::send(new Response([
					'success' => false,
					'errorMessage' => $e->getMessage(),
					'errorCode' => 500,
					'errorStack' => $e->getTrace(),
					'errorLine' => $e->getLine(),
					'errorFile' => $e->getFile()
				]));
				logIt(json_encode([
					'params' => $this->reader->getParams(),
					'errorMessage' => $e->getMessage(),
					'errorCode' => 500,
					'errorStack' => $e->getTrace(),
					'errorLine' => $e->getLine(),
					'errorFile' => $e->getFile()
				]));
			}
		}
	}

	private function initProcess()
	{
		$process_name = $this->reader->getProcessName();
		$this->process = $this->getProcess($process_name);
	}

	private function getProcess($name)
	{
		$binds =  $this->bind();
		$factories = $this->factories();
		
		if (!is_array($binds)) throw new InvalidArgumentException("O método bind() deve retornar um array", 1);
		
		if (isset($binds[$name])) {
			if (!isset($factories[$binds[$name]])) {
				$class = "\\" . $binds[$name];
				$process = new $class;
			} else {
				$class = "\\" . $factories[$binds[$name]];
				$factory = new $class;
				$process = $factory->make(); 
			}
			
			$process->setReader($this->reader);
			$process->initProcess();
			return $process;
		}

		return new NullProcess($this->reader);
		
	}

	private function needsParams($process)
	{
		return count(get_class_vars(get_class($this->process))) > 0;
	}

}