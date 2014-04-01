#!/usr/bin/php
<?php
function askNumber()
{
	echo "Entrez un nombre: ";
	$number = trim(fgets(STDIN));
	if (!feof(STDIN))
	{
		if (preg_match("/^[0-9]*$/", $number))
		{
			if ($number % 2 == 0)
				echo "Le chiffre $number est Pair !\n";
			else
				echo "Le chiffre $number est Impair !\n";
		}
		else
		{
			echo "'$number' n'est pas un chiffre\n";
		}
		return askNumber();
	}
	else
		echo "\n";
}
askNumber();
?>