#!/usr/bin/php
<?php
function ft_ssap_two($str)
{
	function clean_element($a)
	{
		return (trim($a));
	}

	function drop_element($a)
	{
		return (strlen($a));
	}

	function filter_get_num($a)
	{
		return (preg_match("/^[0-9]*$/", $a));
	}

	function filter_get_str($a)
	{
		return (preg_match("/^[A-Za-z]*$/", $a));
	}

	array_shift($str);
	$str = implode(" ", $str);
	$cleaned = array_map("clean_element", explode(" ", $str));
	$arr = array_filter($cleaned, "drop_element");
	$strings = array_filter($arr, "filter_get_str");
	$nums = array_filter($arr, "filter_get_num");
	$others = array_diff($arr, $strings, $nums);
	$arr = array_reverse($arr);
	usort($nums, 'strcasecmp');
	usort($others, 'strcasecmp');
	usort($strings, 'strcasecmp');
	foreach (array_merge($strings, $nums, $others) as $key => $value) {
		echo "$value\n";
	}
}
if (count($argv) > 1)
	ft_ssap_two($argv);
?>