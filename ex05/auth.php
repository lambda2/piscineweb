<?php

function auth($login, $password)
{
	$file = "../private/passwd";
	if (file_exists($file))
		$db = unserialize(file_get_contents($file));
	else
	{
		if (!file_exists("../private"))
			mkdir("../private");
		$db = array();
	}
	$hashpass = hash("sha256", $password);
	foreach ($db as $key => $item)
	{
		if ($item["login"] == $login
			and $item["passwd"] == $hashpass)
		{
			return (true);
		}
	}
	return (false);
}

?>