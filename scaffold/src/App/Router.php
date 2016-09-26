<?php

namespace App;

use ProcessManager\Processes\ProcessContainer;

class Router extends ProcessContainer 
{
	protected function bind() {
		return [
			"example" => \App\Processes\ExampleProcess::class,
		];
	}

	protected function factories() {
		return [
			\App\Processes\ExampleProcess::class => 
				\App\Processes\Factories\ExampleFactory::class,
		];
	}
}