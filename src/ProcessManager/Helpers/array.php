<?php

if (!function_exists('array_keys_exists_each')) {
	function array_keys_exists_each($value, $data, $function)
	{
		if (isset($data[$value])) {
			foreach ($data[$value] as $value) {
				return $function($value);
			}
		}
		return null;
	}
}

if (!function_exists('array_keys_exists_callback')) {
	function array_keys_exists_callback($value, $data, $callback)
	{
		if (isset($data[$value])) {
			return $callback($data[$value]);
		}
		return null;
	}
}

if (!function_exists('check_callback')) {
	function check_callback($value, $callback)
	{
		if (!empty($value)) {
			return $callback($value);
		}
		return null;
	}
}

if (!function_exists('check_each')) {
	function check_each($values, $function)
	{
		if (!empty($values)) {
			for( $index = 0; $index < count($values); $index++) {
				return $function($values[$index], $index);
			}
		}
		return null;
	}
}