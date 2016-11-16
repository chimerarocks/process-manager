<?php

namespace ProcessManager\ORM;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

class ORMManager {

	public static $instance;

	private function __construct()
	{}

	public static function getInstance()
	{
		if (!isset(self::$instance) || !self::$instance->isOpen()) {

			$paths = DB_PATHS;
			$isDevMode = DB_DEV;

			$config = Setup::createYamlMetadataConfiguration($paths, $isDevMode);

			$dbParams = [
				'driver' 	=> DB_DRIVER,
				'user' 		=> DB_USER,
				'password'	=> DB_PASSWORD,
				'dbname'	=> DB_DBNAME
			];
			self::$instance = EntityManager::create($dbParams, $config);
		}

		return self::$instance;
	}

}