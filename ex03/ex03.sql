INSERT INTO `ft_table` (
	SELECT NULL as id, `nom`, "other" AS groupe, DATE(`date_naissance`)
	FROM `fiche_personne` f
	WHERE f.nom LIKE '%a%' AND CHAR_LENGTH(f.nom) < 9
	ORDER BY `nom` ASC LIMIT 10
);