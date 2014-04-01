#!/usr/bin/php
<?php
function ft_rostring($str)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	function array_rotate(&$arr)
	{
		$elm = array_shift($arr);
		array_push($arr, $elm);
		return $elm;
	}

	$cleaned = array_map("clean_element", explode(" ", $str));
	$filtered = array_filter($cleaned, "drop_element");
	array_rotate($filtered);
	return (implode(" ", $filtered));
}

if (count($argv) > 1)
	echo ft_rostring($argv[1]) . "\n";
?>