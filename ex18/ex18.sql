SELECT nom
FROM distrib
WHERE
		FIND_IN_SET(id_distrib, "42,62,63,64,65,66,67,68,69,71,88,89,90") -- fait partie de la liste
	OR -- OU alors
		(SELECT LOWER(nom) REGEXP("^[^y]*y[^y]*y[^y]*$")) -- contient seulement deux y
LIMIT 2,5; -- On part du troisieme resultat