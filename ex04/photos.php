#!/usr/bin/php
<?php

function get_site_contents($url)
{
	return `curl $url`;
}

function get_images_urls($content)
{
	echo "$content\n\n===================================\n\n";
	$regex = "~<img (\w=\"\w\")*src=\"(?P<url>[^\"]*)\"~Ui";
	$e = preg_match_all($regex, $content, $matches);
	echo "$e\n";
	var_dump($matches);
}

function download_files($dir, $files)
{

}

if (count($argv) > 1)
{
	$content = get_site_contents($argv[1]);
	$urls = get_images_urls($content);
}

?>