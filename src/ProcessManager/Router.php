<?php

namespace ProcessManager;

use ProcessManager\Processes\ProcessContainer;

class Router 
{
	private $container;

	public function __construct(ProcessContainer $container) {

		$this->container = $container;

	}

	public function process() {

		return $this->container->run();

	}
}