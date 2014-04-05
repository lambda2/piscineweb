<?php

date_default_timezone_set("Europe/Paris");

session_start();

/**
 * Will return an array containing all elements of the given
 * serialized database.
 */
function getDb($file = "../private/chat")
{
	$db = array();
	if (file_exists($file))
	{
		$h = fopen($file, "r+");
		if (flock($h, LOCK_SH))
		{
			$ct = file_get_contents($file);
		    flock($h, LOCK_UN);    // Enlève le verrou
			$db = unserialize($ct);
		}
		fclose($h);
	}
	else
	{
		if (!file_exists("../private"))
			mkdir("../private");
	}
	return ($db);
}

/**
 * Will save the given db array into the given file,
 * in a serialized format.
 */
function saveDb($db, $file = "../private/chat")
{
	if (!file_exists("../private"))
		mkdir("../private");
	$content = serialize($db);
	file_put_contents($file, $content, LOCK_EX);
}

/**
 * Will check that the forms arguments are here and corrects
 */
function checkFormArgs($f)
{
	return (
		$f and isset($f["submit"]) and $f["submit"] = "ok"
		and isset($f["msg"]) and $f["msg"] != ""
		and isset($_SESSION["loggued_on_user"])
	);
}

/*
 * Si on a qque chose dans le formulaire
 */
if (checkFormArgs($_POST))
{
	$db = getDb();

	$msg = array(
		"login" => $_SESSION["loggued_on_user"],
		"time" => time(),
		"msg" => $_POST["msg"]
	);
	$db[] = $msg;
	saveDb($db);
	echo "<script langage=\"javascript\">top.frames['chat'].location = 'chat.php';</script>";
}

?>

<html>
	<body>
		<form action="speak.php" method="POST">
		    <label for="input-msg">Message: </label><input autofocus id="input-msg" type="text" name="msg">
		    <input type="submit" name="submit" value="OK">
		</form>
	</body>
</html>

