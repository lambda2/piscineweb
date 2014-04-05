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
 * @return bool if is valid, false otherwise
 */
function checkFormArgs($f)
{
	return (
		$f and isset($f["submit"]) and $f["submit"] = "ok"
		and isset($f["login"]) and $f["login"] != ""
		and isset($f["oldpw"]) and $f["oldpw"] != ""
		and isset($f["newpw"]) and $f["newpw"] != ""
	);
}

function in_da_array($item, $array)
{
	foreach ($array as $key => $value)
	{
		if ($value === $item)
			return (true);
	}
	return (false);
}

/**
 * Will check if the login / password combinaison
 * is valid.
 * @return bool if is valid, false otherwise
 */
function passIsValid($login, $pass, $db)
{
	$logins = array();
	foreach ($db as $key => $item)
	{
		if ($item["login"] == $login
			and $item["passwd"] == $pass)
		{
			return (true);
		}
	}
	return (false);
}


if (checkFormArgs($_POST))
{
	$db = getDb();

	if (!passIsValid($_POST["login"], hash("sha256", $_POST["oldpw"]), $db))
	{
		echo "ERROR\n";
	}
	else
	{
		foreach ($db as $key => $item)
		{
			if ($item["login"] == $_POST["login"])
			{
				$db[$key] = array(
					"login" => $_POST["login"],
					"passwd" => hash("sha256", $_POST["newpw"])
				);
			}
		}
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