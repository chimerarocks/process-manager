<?php

namespace ProcessManager\Processes;

interface TaskInterface 
{
	public function execute(array $args);
}