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

if (isset($_SESSION["loggued_on_user"]))
{
	$db = getDb();
	header("Refresh: 5;url=chat.php#bot");
	foreach ($db as $key => $message)
	{
		$time = date("H:i", $message["time"]);
		?>

		<p>[<?= $time ?>]<b><?= $message["login"] ?></b> <?= $message["msg"] ?></p>

		<?php
	}
	?>
	<a href="bot">       </a>
	<?php
}

?>