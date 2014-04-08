SELECT
	g.id_genre,
	g.nom as "nom genre",
	d.id_distrib,
	d.nom as "nom distrib",
	f.titre as "titre film"
FROM film f 
	LEFT OUTER JOIN genre g
		ON f.id_genre = g.id_genre 
	LEFT OUTER JOIN distrib d
		ON f.id_distrib = d.id_distrib 
WHERE
(
		f.id_genre >= 4
	AND
		f.id_genre <= 8
);