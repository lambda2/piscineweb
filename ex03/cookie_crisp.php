<?php
if (isset($_GET["action"]))
{
	$action = $_GET["action"];
	switch ($action)
	{
		case 'get':
			if (isset($_GET["name"]) && isset($_COOKIE[$_GET["name"]]))
			{
				echo $_COOKIE[$_GET["name"]];
			}
			break;

		case 'set':
			setcookie($_GET["name"], $_GET["value"], time()+60*60*24*30);
			break;

		case 'del':
			setcookie($_GET["name"], "", time()-60*60*24*30);
			break;
		
		default:
			# nothing...
			break;
	}
}
?>