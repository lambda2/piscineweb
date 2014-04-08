SELECT UPPER(p.nom) AS "NOM", p.prenom, a.prix
FROM fiche_personne p
	INNER JOIN membre m 
		ON p.id_perso = m.id_fiche_perso
	INNER JOIN abonnement a 
		ON m.id_abo = a.id_abo
WHERE a.prix > 42
ORDER BY 
	p.nom ASC,
	p.prenom ASC
;