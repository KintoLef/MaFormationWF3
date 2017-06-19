-- Une valeur NULL se test avec IS
-- Voir les ID des livres qui n'ont pas encore été rendu
SELECT id_livre FROM emprunt WHERE date_rendu IS NULL;
-- l'inverse : IS NOT
SELECT id_livre FROM emprunt WHERE date_rendu IS NOT NULL;

--# REQUETES IMBRIQUEES
-- Les titres des livres qui n'ont pas été rendu
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL);
-- pour faire une requête imbriquée ou en jointure (voir plus bas) il faut obligatoirement un champ commun. Sur la requête au dessus, le champ en commun est id_livre.

-- Nous aimerions connaître le n° (id) des livres que Chloe à emprunté.
SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe');

-- EXERCICE : Affichez les prénoms des abonnés ayant emprunté un livre le 19/12/2014.
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE date_sortie = '2014-12-19');

-- EXERCICE : Combien de livre Guillaume a emprunté
SELECT COUNT(*) FROM emprunt WHERE id_abonne = (SELECT id_abonne FROM abonne WHERE prenom = 'Guillaume');

-- EXERCICE : Afficher les prenoms des abonnés ayant déjà emprunté un livre écrit par Alphonse Daudet
SELECT prenom FROM abonne WHERE id_abonne IN (SELECT id_abonne FROM emprunt WHERE id_livre IN (SELECT id_livre FROM livre WHERE auteur = 'ALPHONSE DAUDET'));

-- EXERCICE : Afficher les titres des livres que Chloe n'a pas encore emprunté
SELECT titre FROM livre WHERE id_livre NOT IN (SELECT id_livre FROM emprunt WHERE id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'));

-- EXERCICE : Quels sont le ou les titres des livres que Chloe n'a pas encore rendu à la bibliothèque.
SELECT titre FROM livre WHERE id_livre IN (SELECT id_livre FROM emprunt WHERE date_rendu IS NULL AND id_abonne IN (SELECT id_abonne FROM abonne WHERE prenom = 'Chloe'));

-- EXERCICE : Qui a emprunté le plus de livres à la bibliothèque
SELECT prenom FROM abonne WHERE id_abonne = (SELECT id_abonne FROM emprunt GROUP BY id_abonne ORDER BY COUNT(id_livre) DESC LIMIT 0, 1);

--Version jointure :
SELECT a.prenom, COUNT(*) AS 'Nb de livre emprunté'
FROM abonne a, emprunt e
WHERE a.id_abonne = e.id_abonne
GROUP BY e.id_abonne
ORDER BY COUNT(e.id_livre) DESC LIMIT 0,1;


--# REQUETES EN JOINTURES
-- Une requête en jointure sera possible dans tous les cas,
-- Une requête imbriquée n'est possible que si les informations que l'on récupère ne proviennent que d'une seule table.

-- Nous aimerions connaître les dates de sortie et les dates de rendu pour l'abonne Guillaume
SELECT abonne.prenom, emprunt.date_sortie, emprunt.date_rendu 
FROM emprunt, abonne 
WHERE emprunt.id_abonne = abonne.id_abonne 
AND abonne.prenom = 'Guillaume';

-- première ligne -> ce que l'on veut récupérer
-- deuxièeme ligne -> de quelles tables avons nous besoin
-- troisième ligne et les suivantes -> la ou les conditions + les éventuels GROUP BY / ORDER BY / etc ...

-- EXERCICE : Nous aimerions connaître les dates de sortie et de rendus pour les livres écrits par Alphonse DAUDET
SELECT emprunt.date_sortie, emprunt.date_rendu 
FROM emprunt, livre 
WHERE emprunt.id_livre = livre.id_livre 
AND livre.auteur = 'ALPHONSE DAUDET';

-- EXERCICE : Qui a emprunté le livre une vie sur l'année 2014
SELECT abonne.prenom, emprunt.date_sortie 
FROM abonne, emprunt, livre 
WHERE abonne.id_abonne = emprunt.id_abonne 
AND emprunt.id_livre = livre.id_livre 
AND livre.titre = 'Une vie' 
AND emprunt.date_sortie LIKE '2014%';

-- EXERCICE : Nous aimerions connaître le nombre de livre(s) emprunté par chaque abonné
SELECT abonne.prenom, COUNT(emprunt.id_livre) 
FROM abonne, emprunt 
WHERE abonne.id_abonne = emprunt.id_abonne
GROUP BY abonne.id_abonne 
ORDER BY COUNT(emprunt.id_livre) DESC;

-- EXERCICE : Qui a emprunté quoi et quand
SELECT abonne.prenom, livre.titre, emprunt.date_sortie 
FROM abonne, emprunt, livre 
WHERE livre.id_livre = emprunt.id_livre 
AND abonne.id_abonne = emprunt.id_abonne
ORDER BY emprunt.date_sortie;

-- Ajout d'un abonné dans la Table Abonne
INSERT INTO abonne (id_abonne, prenom) VALUES (NULL, 'Quentin');

-- Si on fait la dernière requête SELECT, la dernière INSERT ne sera pas présente du fait de ne pas avoir d'emprunt (abonne.id_abonne = emprunt.id_abonne).

-- Dans ce cas, afin de récupérer tout le contenu d'une table pour ensuite y joindre les informations d'une autre selon la relation entre les tables -> LEFT JOIN ou RIGHT JOIN

-- Afficher les prenoms et les id_livre qu'ils ont emprunté
SELECT a.prenom, e.id_livre 
FROM abonne a, emprunt e 
WHERE a.id_abonne = e.id_abonne;

-- La même requête sans correspondance exigée
SELECT a.prenom, e.id_livre 
FROM abonne a 
LEFT JOIN emprunt e 
ON a.id_abonne = e.id_abonne;

	-- OU --
	
SELECT a.prenom, e.id_livre 
FROM emprunt e 
RIGHT JOIN abonne a 
ON a.id_abonne = e.id_abonne;

-- Ajout d'un livre dans la Table Livre
INSERT INTO livre (id_livre, auteur, titre) VALUES 
(NULL, 'BRIAN M. BENDIS', 'Avengers');

-- Afficher tous les titres et les id_abonne des emprunteurs
SELECT l.titre, e.id_abonne
FROM livre l
LEFT JOIN emprunt e 
ON l.id_livre = e.id_livre;

-- Afficher tous les titres et le prenom des emprunteurs
SELECT l.titre, a.prenom
FROM livre l
LEFT JOIN emprunt e
ON l.id_livre = e.id_livre
LEFT JOIN abonne a
ON e.id_abonne = a.id_abonne;




















