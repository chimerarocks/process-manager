<?php

$GLOBALS["ENVIRONMENT"] = yaml_parse_file(__DIR__ . '/../../../env.yaml');

if (!function_exists('env')) {
	function env($var, $or = false)
	{
		if (isset($GLOBALS["ENVIRONMENT"][$var]))
			return $GLOBALS["ENVIRONMENT"][$var];
		else 
			return $or;
	}
}