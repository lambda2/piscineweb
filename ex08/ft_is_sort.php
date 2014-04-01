#!/usr/bin/php
<?php
function ft_is_sort($tab)
{
	$ref = $tab;
	usort($ref, 'strcmp');
	return (count(array_diff_assoc($ref, $tab)) == 0);
}
?>