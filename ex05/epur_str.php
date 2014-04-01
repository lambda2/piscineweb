#!/usr/bin/php
<?php
function ft_epur($str)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	$cleaned = array_map("clean_element", explode(" ", $str));
	return implode(" ", array_filter($cleaned, "drop_element"));
}
if (count($argv) > 1)
	var_dump(ft_epur($argv[1]));
?>