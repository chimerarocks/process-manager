<?php

namespace ProcessManager\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class LoggerFactory
{
	private static $log;

	private function __construct()
	{}

	private static function make()
	{
		self::$log = new Logger('Log');
		self::$log->pushHandler(new StreamHandler(LOG_PATH, Logger::WARNING));
	}

	public static function getInstance()
	{
		if (null == self::$log) {
			self::make();
		}
		return self::$log;
	}
}