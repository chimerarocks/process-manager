<?php

use ProcessManager\Services\LoggerFactory;

if (!function_exists('logIt')) {
	function logIt($message, $level = 'warning')
	{
		$log = LoggerFactory::getInstance();
		switch ($level) {
			case 'warning':
					$log->warning($message);
				break;
			case 'error':
					$log->error($message);
				break;
			default:
					$log->warning($message);
				break;
		}
	}
}