USE wf3_entreprise;
START TRANSACTION; --# Démarre la zone de mise en tampon
SELECT * FROM employes;

UPDATE employes SET prenom = 'Test_transaction' WHERE id_employes = 350;
SELECT * FROM employes;

ROLLBACK; --# annule toutes les opérations effectuées durant cette transaction
SELECT * FROM employes;

COMMIT; --# à l'inverse le COMMIT va valider toutes les actions effectuées durant la transaction.

--# si l'on ferme la session en cours et qu'aucun COMMIT ou ROLLBACK n'a été effectué, ce sera un ROLLBACK par défaut.

--# TRANSACTION AVANCEE & SAVEPOINT
SELECT * FROM employes;

START TRANSACTION;

SAVEPOINT point1;
UPDATE employes SET salaire = 1500 WHERE id_employes = 350;
SELECT * FROM employes;

SAVEPOINT point2;
UPDATE employes SET salaire = 5000 WHERE service = 'informatique';
SELECT * FROM employes;

SAVEPOINT point3;
UPDATE employes SET salaire = 100;
SELECT * FROM employes;

SAVEPOINT point4;
UPDATE employes SET salaire = 2000;
SELECT * FROM employes;

ROLLBACK TO point2;  -- on revient au point2 et toutes les actions effectuées par la suite ont été annulées
SELECT * FROM employes;

ROLLBACK TO point4; -- SAVEPOINT point4 does not exist -- le point à été annulé lors du précédent ROLLBACK (point2).

ROLLBACK point1; -- ici ok car le point1 existe toujours du fait d'avoir été déclaré avant le point2.

ROLLBACK; -- on annule tout depuis le déut de la transaction (elle se termine alors).

