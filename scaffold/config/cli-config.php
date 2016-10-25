<?php


	require_once __DIR__ . "/../vendor/autoload.php";
	require_once __DIR__ . "/../lib/ProcessManager/kernel.php";

	use Doctrine\ORM\Tools\Console\ConsoleRunner;
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;

	$paths = DB_PATHS;
	$isDevMode = DB_DEV;

	$config = Setup::createYamlMetadataConfiguration($paths, $isDevMode);

	$dbParams = [
		'driver' 	=> DB_DRIVER,
		'user' 		=> DB_USER,
		'password'	=> DB_PASSWORD,
		'dbname'	=> DB_DBNAME
	];
	$entityManager = EntityManager::create($dbParams, $config);

	return ConsoleRunner::createHelperSet($entityManager);