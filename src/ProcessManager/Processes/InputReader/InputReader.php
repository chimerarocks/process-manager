<?php

	namespace ProcessManager\Processes\InputReader;

	abstract class InputReader
	{

		protected $args;

		public function __construct($args)
		{
			$this->args = $args;
			$this->setRunEnvironment();
		}

		abstract public function getParams();

		abstract public function getProcessName();

		abstract public function setRunEnvironment();
	}