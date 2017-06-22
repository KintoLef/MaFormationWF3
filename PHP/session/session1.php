<?php
// pour voir les fichiers de session -> dossier tmp à la racine du serveur (xampp, wamp, mamp ...)

// pour créer une session
session_start(); // crée une session ou ne fait que l'ouvrir si elle existe déjà.
// lors de la création d'une session, un cookie d'identifiant est créé côté utilisateur pour avoir le lien entre la session et l'utilisateur
// comme pour setCookie(), la fonction session_start() doit être éxecutée avant le moindre affichage html !!!

$_SESSION['pseudo'] = 'Marie'; // $_SESSION est une superglobale, toutes les superglobales sans exception sont des tableaux ARRAY. Il est donc possible de créer des indices avec valeurs dans notre session.
$_SESSION['password'] = 'soleil';
$_SESSION['email'] = 'mail@mail.fr';
$_SESSION['age'] = 40;
$_SESSION['adresse']['code_postal'] = 75000;
$_SESSION['adresse']['ville'] = 'Paris';
$_SESSION['adresse']['rue'] = '18 rue Geoffroy l\'Asnier';

echo 'Premier affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// pour supprimer un élément de la session:
unset($_SESSION['password']);

echo 'Deuxième affichage de la session: <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

// pour détruire la session
session_destroy(); // nous permet de supprimer la session, EN REVANCHE il faut savoir que l'information session_destroy() est vu par l'interpréteur php, mise de côté puis éxecutée uniquement à la fin du script en cour.

echo 'Troisième affichage de la session après le session_destroy(): <br />';
echo '<pre>'; print_r($_SESSION); echo '</pre>';

