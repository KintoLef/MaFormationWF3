-- 1. Qui conduit la voiture 503
SELECT c.prenom, c.nom
FROM conducteur c, association_vehicule_conducteur avc
WHERE avc.id_conducteur = c.id_conducteur
AND avc.id_vehicule = 503;

-- 2. Qui conduit quoi
SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c, association_vehicule_conducteur avc, vehicule v
WHERE avc.id_conducteur = c.id_conducteur
AND avc.id_vehicule = v.id_vehicule;

-- 3. Ajoutez-vous dans la table conducteur, ensuite, affichez tous les conducteurs (même ceux qui ne sont pas présents sur la table association_vehicule_conducteur) ainsi que les véhicules qu'ils conduisent si c'est le cas.
INSERT INTO conducteur (id_conducteur, prenom, nom) VALUES
(NULL, 'Quentin', 'Lefevre');

SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
LEFT JOIN association_vehicule_conducteur avc
ON avc.id_conducteur = c.id_conducteur
LEFT JOIN vehicule v
ON avc.id_vehicule = v.id_vehicule;

-- 4. Ajoutez un nouveau véhicule sur la table véhicule. Ensuite, affichez tous les véhicules (même ceux qui ne sont pas présents sur la table association_vehicule_conducteur) ainsi que leur conducteur si c'est le cas.
INSERT INTO vehicule (id_vehicule, marque, modele, couleur, immatriculation) VALUES
(NULL, 'DeLorean', 'DMC-12', 'gris', 'BC-985-FT');

SELECT v.marque, v.modele, c.prenom, c.nom
FROM vehicule v
LEFT JOIN association_vehicule_conducteur avc
ON  avc.id_vehicule = v.id_vehicule
LEFT JOIN conducteur c
ON avc.id_conducteur = c.id_conducteur;

-- 5. Affichez tous les véhicules et tous les conducteurs sans exception qu'ils soient présent ou non sur association_vehicule_conducteur.
SELECT c.prenom, c.nom, v.marque, v.modele
FROM conducteur c
LEFT JOIN association_vehicule_conducteur avc
ON avc.id_conducteur = c.id_conducteur
LEFT JOIN vehicule v
ON avc.id_vehicule = v.id_vehicule
UNION
SELECT c.prenom, c.nom, v.marque, v.modele
FROM vehicule v
LEFT JOIN association_vehicule_conducteur avc
ON  avc.id_vehicule = v.id_vehicule
LEFT JOIN conducteur c
ON avc.id_conducteur = c.id_conducteur;