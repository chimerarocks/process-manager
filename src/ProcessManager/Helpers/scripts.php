<?php

if (!function_exists('phantomjs')) {
	function phantomjs($script_path, $args = [])
	{
		if (null != PHANTOMJS_PATH) {
			$cmd = PHANTOMJS_PATH . " ";

			foreach ($args as $value) {
				$cmd .= $value . " ";
			}

			exec($cmd . $script_path, $output);
			return $output;
		}
		else
			throw new Exception("To use phantomjs() helper you have to set a PHANTOMJS_PATH Constant at the env.php file");
	}
}

if (!function_exists('load_script')) {
	function load_script($script_name, $args)
	{

		if (file_exists(SCRIPTS_PATH . "/" . $script_name)){
			$string = $script_name . " ";

			foreach ($args as $value) {
				$string .= $value . " ";
			}

			return SCRIPTS_PATH . "/" . $string;
			
		}
		else 
			throw new Exception("Error on loading script: " . $script_name . " not exists.");

	}
}