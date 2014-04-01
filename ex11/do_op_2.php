#!/usr/bin/php
<?php

function do_op($args)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	function is_num($a)
	{
		return (preg_match("/^[\d]*$/", $a));
	}

	function is_op($a, $ref)
	{
		return (in_array($a, array_keys($ref)));
	}

	$operations = array(
		"+" => function($a, $b){ return $a + $b; },
		"-" => function($a, $b){ return $a - $b; },
		"/" => function($a, $b){ return $a / $b; },
		"*" => function($a, $b){ return $a * $b; },
		"%" => function($a, $b){ return $a % $b; }
	);

	if (!preg_match_all("/\+|-|\/|%|\*/", trim($args), $res))
	{
		echo "Syntax Error\n";
		return (1);
	}
	$split = preg_split("/\+|-|\/|%|\*/", trim($args));
	$cleaned = array_map("clean_element", $split);
	$arr = array_values(array_filter($cleaned, "drop_element"));
	if (is_num($arr[0]) && is_num($arr[1]))
	{
		$result = $operations[$res[0][0]]($arr[0], $arr[1]);
		echo "$result\n";
	}
	else
		echo "Syntax Error\n";
}
if (count($argv) == 2)
	do_op($argv[1]);
else
	echo "Incorrect Parameters\n";
?>