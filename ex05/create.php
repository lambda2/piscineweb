<?php

/**
 * Will return an array containing all elements of the given
 * serialized database.
 */
function getDb($file = "../private/passwd")
{
	if (file_exists($file))
		$db = unserialize(file_get_contents($file));
	else
	{
		if (!file_exists("../private"))
			mkdir("../private");
		$db = array();
	}
	return ($db);
}

/**
 * Will save the given db array into the given file,
 * in a serialized format.
 */
function saveDb($db, $file = "../private/passwd")
{
	if (!file_exists("../private"))
		mkdir("../private");
	$content = serialize($db);
	return (file_put_contents($file, $content));
}

/**
 * Will check that the forms arguments are here and corrects
 */
function checkFormArgs($f)
{
	return (
		$f and isset($f["submit"]) and $f["submit"] = "ok"
		and isset($f["login"]) and $f["login"] != ""
		and isset($f["passwd"]) and $f["passwd"] != ""
	);
}

function in_da_array($item, $array)
{
	foreach ($array as $key => $value) {
		if ($value === $item)
			return (true);
	}
	return (false);
}

/**
 * Will check if the given login exists in the given $db array
 */
function loginExists($login, $db)
{
	$logins = array();
	foreach ($db as $key => $item)
	{
		if ($item)
			$logins[] = $item["login"];
	}
	return (in_da_array($_POST["login"], $logins));
}

/*
 * Si on a qque chose dans le formulaire
 */
if (checkFormArgs($_POST))
{
	$db = getDb();

	if (loginExists($_POST["login"], $db))
	{
		echo "ERROR\n";
	}
	else
	{
		// Create a new array with the user login and an hashed password.
		$infos = array(
			"login" => $_POST["login"],
			"passwd" => hash("sha256", $_POST["passwd"])
		);
		$db[] = $infos;
		saveDb($db);
		header("Location: index.html");
		echo "OK\n";
	}
}
else
{
	echo "ERROR\n";
}
?>