#!/usr/bin/php
<?php

/*

Tentatives...

<a+((?<attr>\s+\w+(\s*=\s*(?:".*?"|'.*?'|[^'">\s]+))?)+\s*|\s*)\/?>([^<]*)(<\w+((\s+\w+(\s*=\s*(?:".*?"|'.*?'|[^'">\s]+))?)+\s*|\s*)>)?<\/a> => pas trop mal...


*/
function link_up($file)
{

	function replaceTitle($str)
	{
		/**
		 * Regex for match title attributes
		 */
		$regex = "~<a(?P<beforetag>\s+(.*=.*)title=[\"\'])"
		."(?P<title>[^\"\'<>]+[\"\'])|"
		."(?P<aftertag>\w+=[\"\'][^\"\'<>]+[\"\'])"
		."+>([^<]*)<\/a>~Uim";
		$e = preg_replace_callback(
			$regex,
			function($match)
			{
				$s = "<a".$match["beforetag"];
				if ($match["title"])
					$s .= strtoupper($match["title"]);
				$s .= $match["aftertag"];
				return $s;
			},
			$str
		);
		return ($e);
	}

	function replaceText($str)
	{
		$regex = "~(?<beforetext><a\s[^>]*>)(?<text>[^<]*)"
				."(?<aftertext>(<([A-Za-z][A-Za-z0-9]*)"
				."\s[^>]*>(.*?)<\/\1>)?(.*)?<\/a>)~im";
		$e = preg_replace_callback(
			$regex,
			function($match)
			{
				$s = $match["beforetext"];
				if ($match["text"])
					$s .= strtoupper($match["text"]);
				$s .= $match["aftertext"];
				return $s;
			},
			$str
		);
		return ($e);
	}

	if (file_exists($file))
	{
		$str = file_get_contents($file);
		if ($str)
		{
			$str = replaceText(replaceTitle($str));
			echo $str."\n";
		}
	}
}
if (count($argv) > 1)
	link_up($argv[1]);
?>