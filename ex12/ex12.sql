SELECT nom, prenom
FROM fiche_personne f 
WHERE 
		f.nom REGEXP '[- ]{1,}'
	OR
		f.prenom REGEXP '[- ]{1,}'
ORDER BY
	nom ASC, prenom ASC;