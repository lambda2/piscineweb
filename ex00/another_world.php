#!/usr/bin/php
<?php
function another_world($str)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	$str = str_replace("\t", " ", $str);
	$cleaned = array_map("clean_element", explode(" ", $str));
	return implode(" ", array_filter($cleaned, "drop_element"));
}
if (count($argv) > 1)
	echo another_world($argv[1]) . "\n";
?>