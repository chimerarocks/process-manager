<?php

if (file_exists(BASE_PATH . '/env.yaml')) {
	$GLOBALS["ENVIRONMENT"] = \Symfony\Component\Yaml\Yaml::parse(file_get_contents(BASE_PATH . '/env.yaml'));
} else {
	throw new Exception("Env file was not created.", 1);
}


if (!function_exists('env')) {
	function env($var, $or = false)
	{
		if (isset($GLOBALS["ENVIRONMENT"][$var]))
			return $GLOBALS["ENVIRONMENT"][$var];
		else 
			return $or;
	}
}