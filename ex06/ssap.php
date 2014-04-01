#!/usr/bin/php
<?php
function ft_ssap($str)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	array_shift($str);
	$str = implode(" ", $str);
	$cleaned = array_map("clean_element", explode(" ", $str));
	$arr = array_filter($cleaned, "drop_element");
	usort($arr, 'strcmp');
	foreach ($arr as $key => $value) {
		echo "$value\n";
	}
}
if (count($argv) > 1)
	ft_ssap($argv);
?>