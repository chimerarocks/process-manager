<?php

namespace ProcessManager;

use ProcessManager\Processes\InputReader\CliInputReader;
use ProcessManager\Processes\InputReader\HttpInputReader;
use ProcessManager\Processes\ProcessContainer;
use ProcessManager\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . "/kernel.php";

class Server
{
	public function __construct(ProcessContainer $container, $argv = null)
	{
		if (php_sapi_name() == 'cli') {
			$reader = new CliInputReader($argv);
			$containerRouted = $container->route($reader);
			$router = new Router($containerRouted);
			$array_response = $router->process();

			echo json_encode(["server" => $array_response]) . "\n";
		} else {
			$server = \Zend\Diactoros\Server::createServer(
				function(ServerRequestInterface $request, ResponseInterface $response) use ($container) {
					$reader = new HttpInputReader($GLOBALS);
					$containerRouted = $container->route($reader);
					$router = new Router($containerRouted);
					return $router->process();
				},$_SERVER, $_GET, $_POST, $_COOKIE, $_FILES);
			$server->listen();
		}
	}
}