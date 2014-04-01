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
		return (preg_match("/^[0-9]*$/", $a));
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

	array_shift($args);
	$args = implode(" ", $args);
	$cleaned = array_map("clean_element", explode(" ", $args));
	$arr = array_values(array_filter($cleaned, "drop_element"));
	/*if (is_num($arr[0]) && is_op($arr[1], $operations) && is_num($arr[2]))*/
	{
		$result = $operations[$arr[1]]($arr[0], $arr[2]);
		echo "$result\n";
	}
}
if (count($argv) == 4)
	do_op($argv);
else
	echo "Incorrect Parameters\n";
?>