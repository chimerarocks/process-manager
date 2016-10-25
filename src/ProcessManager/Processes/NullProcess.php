<?php

namespace ProcessManager\Processes;

use ProcessManager\Response;

use ProcessManager\Processes\Process;

class NullProcess extends Process
{
	public function start()
	{
		return new Response("Nenhum processo selecionado.");		
	}

	public function help()
	{
		return new Response("Nenhum processo selecionado.");
	}
}