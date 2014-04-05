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

if (checkFormArgs($_POST))
{
	if (!auth($_POST["login"], $_POST["passwd"]))
	{
		echo "ERROR\n";
	}
	else
	{
		$_SESSION["loggued_on_user"] = $_POST["login"];
		?>
		<iframe name="chat" src="chat.php" width="100%" height="550px"></iframe>
		<iframe name="speak" src="speak.php" width="100%" height="50px"></iframe>

		<?php
	}
}
else
{
	echo "ERROR\n";
}

?>