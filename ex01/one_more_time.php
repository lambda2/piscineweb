#!/usr/bin/php
<?php
date_default_timezone_set('Europe/Paris');
function another_world($str)
{
	$splitted = explode(" ", $str);
	foreach ($splitted as $key => $value) {
		$splitted[$key] = ucfirst($value);
	}
	$str = implode(" ", $splitted);
	$mois=array(
		"Janvier" => "01"	, "Février" => "02"	,"Mars" => "03"		, "Avril" => "04",
		"Mai" => "05"		, "Juin" => "06"	,"Juillet" => "07"	, "Août" => "08",
		"Septembre" => "09"	, "Octobre" => "10"	,"Novembre" => "11"	, "Décembre" => "12",
		"Fevrier" => "02"	, "Aout" => "08",	"Decembre" => "12" //extra
	);

	$jours=array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi", "Dimanche");

	$pattern = "/^(?P<dayname>"
		.implode("|", $jours)
		.")\s(?P<daynum>[1-9]?[0-9])\s(?P<month>"
		.implode("|", array_keys($mois))
		.")\s(?P<year>[0-9]{4})"
		."\s(?P<hour>[0-2][0-9]:[0-5][0-9]:[0-5][0-9])$/ms";

	if (preg_match_all($pattern, $str, $res))
	{
		$formated = $res["year"][0]."-".$mois[$res["month"][0]]."-".$res["daynum"][0]." ".$res["hour"][0];
		$date = DateTime::createFromFormat('Y-m-j G:i:s', $formated);
		echo $date->getTimeStamp() . "\n";
	}
	else
	{
		echo "Wrong Format\n";
	}
}
if (count($argv) > 1)
	another_world($argv[1]);
?>