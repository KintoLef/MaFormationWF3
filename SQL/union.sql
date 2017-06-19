-- UNION permet de fusionner 2 résultats dans une même liste (colonne)
-- ex : sur le BDD bibliotheque, nous voulons fusionner tous les abonnes et les auteurs dans un même résultats
SELECT prenom AS 'liste personne physique' FROM abonne
UNION
SELECT auteur FROM livre;

-- UNION applique un DISTINCT par défaut.
-- Pour avoir tous les résultats sans DISTINCT, nous pouvons utiliser UNION ALLOCATE
SELECT prenom AS 'liste personne physique' FROM abonne
UNION ALL
SELECT auteur FROM livre;