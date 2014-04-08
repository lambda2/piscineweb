SELECT 
	COUNT(id_abo) as "nb_abo",
	FLOOR(AVG(prix)) as "moy_abo",
	(SUM(duree_abo) % 42) as "ft"
FROM `abonnement`;