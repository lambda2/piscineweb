<?php

session_start();

include_once 'auth.php';

/**
 * Will check that the forms arguments are here and corrects
 * @return bool if is valid, false otherwise
 */
function checkFormArgs($f)
{
	return (
		$f and isset($f["login"]) and $f["login"] != ""
		and isset($f["passwd"]) and $f["passwd"] != ""
	);
}

if (checkFormArgs($_GET))
{

	if (!auth($_GET["login"], $_GET["passwd"]))
	{
		echo "ERROR\n";
	}
	else
	{
		$_SESSION["loggued_on_user"] = $_GET["login"];
		echo "OK\n";
	}
}
else
{
	echo "ERROR\n";
}

?>