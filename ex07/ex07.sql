SELECT titre, resum
FROM `film`
WHERE 
		LOWER(resum) LIKE '%42%'
	OR 
		LOWER(titre) LIKE '%42%'
ORDER BY duree_min ASC;