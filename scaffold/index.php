<?php

require_once __DIR__ . "/vendor/autoload.php";

use ProcessManager\Server;
use App\Router;

$server = new Server(new Router, $argv ?? null);