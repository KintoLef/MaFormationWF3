-- ceci est un commentaire sur une ligne

-- Dans l'invité de commande pour initialiser la bdd avec xampp
-- C:\Users\Etudiant
-- λ cd C:/xampp/mysql/bin

-- C:\xampp\mysql\bin
-- λ mysql --user=root --password=

-- Pour créer une base de données:
CREATE DATABASE wf3_entreprise;

-- Pour voir toutes les BDD sur le serveur:
SHOW DATABASES;

-- Pour utiliser une BDD:
USE nom_de_la_BDD;
USE wf3_entreprise;

-- Pour effacer une BDD:
DROP DATABASE nom_de_la_BDD;

-- Pour effacer une table:
DROP TABLE nom_de_la_table;

-- Vider une table sans l'effacer:
TRUNCATE nom_de_la_table;

-- Pour observer la structure d'une table:
DESC nom_de_la_table;

--# REQUETES SELECTION (question) --------

-- récupération de toutes les données de la table employes:
SELECT id_employes, nom, prenom, sexe, service, date_embauche, salaire FROM employes;

-- il est possible d'afficher tout le contenu d'une table avec le caractère universel *:
SELECT * FROM employes;

-- uniquement les prenoms et les noms:
SELECT prenom, nom FROM employes;

-- Afficher tous les services:
SELECT service FROM employes;
-- idem mais sans répétition:
SELECT DISTINCT service FROM employes;
SELECT DISTINCT service FROM employes WHERE service!='assistant';

-- Affichage des infos des employes du service informatique:
SELECT nom, prenom, service FROM employes WHERE service='informatique';

-- BETWEEN
-- Afficher les employes qui ont été recruté entre 2010 et aujourd'hui
SELECT * FROM employes WHERE date_embauche BETWEEN '2010-01-01' AND '2017-06-14';

-- La date du jour
SELECT CURDATE();

-- LIKE
-- affichage des employes avec un prenom dont la premiere lettre commence par s:
SELECT prenom FROM employes WHERE prenom LIKE 's%';
-- prenom finissant par 'ie':
SELECT prenom FROM employes WHERE prenom LIKE '%ie';
-- prenom comprenant un trait d'union:
SELECT prenom FROM employes WHERE prenom LIKE '%-%';

-- la liste des employes avec un salaire supérieur à 3000:
SELECT nom, prenom, service, salaire FROM employes WHERE salaire > 3000;
-- opératuers de comparaison: >, <, =, !=, >=, <=

-- Pour récupérer les infos avec un ordre précis
SELECT prenom FROM employes ORDER BY prenom ASC; -- ASC = Ascendant -> par défaut
-- l'inverse
SELECT prenom FROM employes ORDER BY prenom DESC; -- DESC = Descendant (à ne pas confondre avec DESC pour Description)

SELECT prenom, salaire FROM employes ORDER BY salaire ASC;
-- pour un deuxième classement
SELECT prenom, salaire FROM employes ORDER BY salaire ASC, prenom ASC;

-- LIMIT
-- affichage des employes 3 par 3
SELECT prenom, nom FROM employes LIMIT 0, 3;
SELECT prenom, nom FROM employes LIMIT 3, 3;
SELECT prenom, nom FROM employes LIMIT 6, 3;
-- avec LIMIT la 1ere valeur correspond à la ligne de départ et la 2eme valeur correspond au nombre de ligne à récupérer.

-- Le salaire annuel des employes
SELECT prenom, salaire*12 FROM employes;
SELECT prenom, salaire*12 AS 'salaire annuel' FROM employes; -- AS = Alias

-- SUM()
-- la masse salariale
SELECT SUM(salaire*12) AS 'Masse Salariale' FROM employes;

-- AVG()
-- le salaire moyen
SELECT AVG(salaire) AS 'Salaire Moyen' FROM employes;
-- ROUND() -> arrondi
SELECT ROUND(AVG(salaire)) AS 'Salaire Moyen' FROM employes;
-- avec deux décimales
SELECT ROUND(AVG(salaire), 2) AS 'Salaire Moyen' FROM employes;

-- COUNT()
-- affichage du nombre de femmes dans la table employes
SELECT COUNT(*) AS 'Nombre de Femmes'FROM employes WHERE sexe='f';

-- MIN()
SELECT MIN(salaire) FROM employes;
-- MAX()
SELECT MAX(salaire) FROM employes;

-- Affichage de la personne qui à le plus bas salaire:
-- /!\ la requête suivante est fausse:
SELECT nom, prenom, MIN(salaire) FROM employes;
-- en effet, le MIN() bloque la requête car elle ne peut renvoyer qu'une seule ligne. Du coup on récupère le premier nom, prenom de la table et le salaire minimum qui ne correspond pas forcément au nom, prenom.
-- Pour avoir la bonne information, dans ce cas précis, nous pouvons utiliser ORDER BY avec LIMIT:
SELECT nom, prenom, salaire FROM employes ORDER BY salaire LIMIT 0, 1;

-- Affichage de la personne qui à le plus haut salaire:
SELECT nom, prenom, salaire FROM employes ORDER BY salaire DESC LIMIT 0, 1;

-- Version requête imbriquée
SELECT nom, prenom, salaire FROM employes WHERE salaire = (SELECT MIN(salaire) FROM employes);

-- IN -> inclusion
SELECT nom, prenom, service FROM employes WHERE service IN('informatique', 'comptabilite');
-- IN permet de faire une comparaison sur plusieurs valeurs (le = -> une seule valeur)

-- NOT IN -> exclusion
SELECT nom, prenom, service FROM employes WHERE service NOT IN('informatique', 'comptabilite');
-- NOT IN (plusieurs valeurs), != (une seule valeur)

-- REQUETE avec plusieurs conditions
-- les employes du service commercial gagnant moins de 2000
SELECT * FROM employes WHERE service = 'commercial' AND salaire <= 2000;

-- les employes du service production ayant un salaire de 1900 ou 2300
SELECT * FROM employes WHERE service = 'production' AND salaire = 1900 OR salaire = 2300; -- /!\ Mauvaise interprétation
SELECT * FROM employes WHERE service = 'production' AND (salaire = 1900 OR salaire = 2300);

-- GROUP BY
-- le nombre d'employes par service
SELECT service, COUNT(*) FROM employes GROUP BY service;

-- pour mettre une ou des conditions avec un GROUP BY
-- HAVING
-- même requête mais avec une condition ( si la valeur du COUNT(*) est supérieur à 2
SELECT service, sexe, COUNT(*) FROM employes GROUP BY service HAVING COUNT(*) > 2;

-- GROUP BY permet de regrouper des informations
-- HAVING permet de mettre une condition sur le GROUP BY

--# REQUETE INSERT (enregistrement)
INSERT INTO employes (id_employes, prenom, nom, sexe, service, date_embauche, salaire) VALUES (NULL, 'Quentin', 'Lefevre', 'm', 'informatique', '2017-06-14', 2200);

-- si nous donnons tous les champs dans le même ordre que la table, il n'est pas nécessaire de préciser les champs
INSERT INTO employes VALUES (NULL, 'Quentin', 'Lefevre', 'm', 'informatique', '2017-06-14', 2200);

-- si l'on fait une insertion sans remplir tous les champs nous sommes obligé de préciser les champs
INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES ('Quentin', 'Lefevre', 'm', 'informatique', '2017-06-14', 2200);

--# REQUETE UPDATE (modification)
UPDATE employes SET salaire = 1391 WHERE id_employes = 699;
-- pour une modification d'une entrée précise, il faut privilégier la condition sur la clé primaire de la table (ici id_employes)
UPDATE employes SET salaire = 1400, service = 'informatique' WHERE id_employes = 699;

--# REQUETE DELETE (suppression)
SELECT * FROM employes;
DELETE FROM employes WHERE id_employes = 993;
SELECT * FROM employes;

DELETE FROM employes WHERE id_employes = 992 AND service = 'informatique';
SELECT * FROM employes;

DELETE FROM employes; -- Cette commande efface toute la table (équivalent à un TRUNCATE)












