#!/usr/bin/php
<?php
function ft_split($str)
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
	$filtered = array_filter($cleaned, "drop_element");
	usort($filtered, 'strcmp');
	return ($filtered);
}
?>