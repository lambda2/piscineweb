#!/usr/bin/php
<?php
function link_up($file)
{
	if (file_exists($file))
	{
		$str = file_get_contents($file);
		if ($str)
		{
			$regex = "~(?P<open><a)(?P<hreftag> href=(?P<href>['|\"].*['|\"]))?"
					.">(?P<label>.*)(?P<close><\/a>)~Ui";
			$e = preg_replace_callback(
				$regex,
				function($match)
				{
					$s = $match["open"];
					if ($match["hreftag"])
						$s .= " href=".strtoupper($match["href"]);
					$s .= ">".strtoupper($match["label"]).$match["close"];
					return $s;
				},
				$str);
			echo "$e\n";
		}
	}
}
if (count($argv) > 1)
	link_up($argv[1]);
?>