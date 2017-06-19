--# EXERCICES

-- 1. Afficher la profession de l'employé ayant l'identifiant 547
SELECT id_employes, service FROM employes WHERE id_employes = 547;
-- commercial

-- 2. Afficher le date d'embauche d'Amandine
SELECT prenom, date_embauche FROM employes WHERE prenom = 'Amandine';
-- 2010-01-23

-- 3. Afficher le nom de famille de Guillaume
SELECT prenom, nom FROM employes WHERE prenom = 'Guillaume';
-- Miller

-- 4. Afficher le nombre d'employes ayant un identifiant commençant par le chiffre 5
SELECT COUNT(*) AS 'Nbr employés avec id commençant par 5'FROM employes WHERE id_employes LIKE '5%'; 
-- 3

-- 5. Afficher le nombre de commerciaux
SELECT COUNT(*) AS 'Nbr de Commerciaux' FROM employes WHERE service = 'commercial';
-- 6

-- 6. Afficher le salaire moyen des informaticiens (arrondi à l'entier)
SELECT ROUND(AVG(salaire)) AS 'Salaire Moyen' FROM employes WHERE service = 'informatique';
-- 1910

-- 7. Afficher les 5 premiers employes après les avoir classé par ordre alphabétique (nom)
SELECT * FROM employes ORDER BY nom ASC LIMIT 0, 5;
--+-------------+---------+----------+------+--------------+---------------+---------+
--| id_employes | prenom  | nom      | sexe | service      | date_embauche | salaire |
--+-------------+---------+----------+------+--------------+---------------+---------+
--|         592 | Laura   | Blanchet | f    | direction    | 2005-06-09    |    4500 |
--|         854 | Daniel  | Chevel   | m    | informatique | 2011-09-28    |    1700 |
--|         547 | Melanie | Collier  | f    | commercial   | 2004-09-08    |    3100 |
--|         699 | Julien  | Cottet   | m    | informatique | 2007-01-18    |    1400 |
--|         739 | Thierry | Desprez  | m    | secretariat  | 2009-11-17    |    1500 |
--+-------------+---------+----------+------+--------------+---------------+---------+

-- 8. Afficher le coût des commerciaux sur une année
SELECT SUM(salaire*12) AS 'Masse Salariale des Commerciaux' FROM employes WHERE service = 'commercial';
-- 184200

-- 9. Afficher le salaire moyen par service (service + salaire moyen)
SELECT service, ROUND(AVG(salaire)) AS 'Salaire moyen' FROM employes GROUP BY service;
--+---------------+---------------+
--| service       | Salaire moyen |
--+---------------+---------------+
--| assistant     |          1775 |
--| commercial    |          2558 |
--| communication |          1500 |
--| comptabilite  |          1900 |
--| direction     |          4750 |
--| informatique  |          1910 |
--| juridique     |          3200 |
--| production    |          2225 |
--| secretariat   |          1550 |
--+---------------+---------------+

-- 10. Afficher le nombre de recrutement sur l'année 2010 (avec un alias si possible)
SELECT COUNT(*) AS 'Nbr de recrutement en 2010' FROM employes WHERE date_embauche LIKE '2010%';
-- 2

-- 11. Afficher le salaire moyen appliqué sur les recrutements de la période allant de 2005 à 2007
SELECT ROUND(AVG(salaire)) AS 'salaire moyen des personnes recrutés entre 2005 et 2007' FROM employes WHERE date_embauche LIKE '2005%' OR date_embauche LIKE '2006%' OR date_embauche LIKE'2007%';
SELECT ROUND(AVG(salaire)) AS 'salaire moyen des personnes recrutés entre 2005 et 2007' FROM employes WHERE date_embauche BETWEEN '2005-01-01' AND '2007-12-31';
-- 2625

-- 12. Afficher le nombre de service différent
SELECT COUNT(DISTINCT service ) AS 'Nbr de service' FROM employes;
-- 9

-- 13. Afficher tous les employés sauf ceux des services production et secrétariat
SELECT * FROM employes WHERE service NOT IN ('production', 'secretariat');
--+-------------+-------------+----------+------+---------------+---------------+---------+
--| id_employes | prenom      | nom      | sexe | service       | date_embauche | salaire |
--+-------------+-------------+----------+------+---------------+---------------+---------+
--|         350 | Jean-pierre | Laborde  | m    | direction     | 1999-12-09    |    5000 |
--|         388 | Clement     | Gallet   | m    | commercial    | 2000-01-15    |    2300 |
--|         415 | Thomas      | Winter   | m    | commercial    | 2000-05-03    |    3550 |
--|         509 | Fabrice     | Grand    | m    | comptabilite  | 2003-02-20    |    1900 |
--|         547 | Melanie     | Collier  | f    | commercial    | 2004-09-08    |    3100 |
--|         592 | Laura       | Blanchet | f    | direction     | 2005-06-09    |    4500 |
--|         627 | Guillaume   | Miller   | m    | commercial    | 2006-07-02    |    1900 |
--|         655 | Celine      | Perrin   | f    | commercial    | 2006-09-10    |    2700 |
--|         699 | Julien      | Cottet   | m    | informatique  | 2007-01-18    |    1400 |
--|         701 | Mathieu     | Vignal   | m    | informatique  | 2008-12-03    |    2000 |
--|         780 | Amandine    | Thoyer   | f    | communication | 2010-01-23    |    1500 |
--|         802 | Damien      | Durand   | m    | informatique  | 2010-07-05    |    2250 |
--|         854 | Daniel      | Chevel   | m    | informatique  | 2011-09-28    |    1700 |
--|         876 | Nathalie    | Martin   | f    | juridique     | 2012-01-12    |    3200 |
--|         933 | Emilie      | Sennard  | f    | commercial    | 2014-09-11    |    1800 |
--|         990 | Stephanie   | Lafaye   | f    | assistant     | 2015-06-02    |    1775 |
--|         991 | Quentin     | Lefevre  | m    | informatique  | 2017-06-14    |    2200 |
--+-------------+-------------+----------+------+---------------+---------------+---------+

-- 14. Afficher le nombre d'hommes et de femmes (sexe + nombre)
SELECT sexe, COUNT(*) AS 'nombre hommes/femmes' FROM employes GROUP BY sexe;
--+------+----------------------+
--| sexe | nombre hommes/femmes |
--+------+----------------------+
--| m    |                   12 |
--| f    |                    9 |
--+------+----------------------+

-- 15. Afficher les commerciaux ayant été recrutés avant 2005 de sexe masculin et gagnat un salaire supérieur à 2500
SELECT * FROM employes WHERE service= 'commercial' AND date_embauche < '2005-01-01' AND sexe = 'm' AND salaire > 2500;
--+-------------+--------+--------+------+------------+---------------+---------+
--| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
--+-------------+--------+--------+------+------------+---------------+---------+
--|         415 | Thomas | Winter | m    | commercial | 2000-05-03    |    3550 |
--+-------------+--------+--------+------+------------+---------------+---------+

-- 16. Qui a été embauché en dernier
SELECT prenom, nom, date_embauche FROM employes ORDER BY date_embauche DESC LIMIT 0, 1;
-- Quentin Lefevre

-- 17. Afficher les informations de l'employé du service commercial ayant le salaire le plus élevé
SELECT * FROM employes WHERE salaire = (SELECT MAX(salaire) FROM employes WHERE service = 'commercial') AND service = 'commercial';
--+-------------+--------+--------+------+------------+---------------+---------+
--| id_employes | prenom | nom    | sexe | service    | date_embauche | salaire |
--+-------------+--------+--------+------+------------+---------------+---------+
--|         415 | Thomas | Winter | m    | commercial | 2000-05-03    |    3550 |
--+-------------+--------+--------+------+------------+---------------+---------+

-- 18. Afficher le prénom de l'employé du service informatique ayant été embauché en premier
SELECT prenom FROM employes WHERE date_embauche = (SELECT MIN(date_embauche) FROM employes WHERE service = 'informatique') AND service = 'informatique';
-- Julien

-- 19. Augmenter le salaire de chaque employé de 100
UPDATE employes SET salaire = salaire+100;
SELECT * FROM employes;

-- 20. Supprimer les employés du service secrétariat uniquement
DELETE FROM employes WHERE service = 'secretariat';