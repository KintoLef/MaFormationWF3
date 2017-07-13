<?php
// mise en place de la connexion à une BDD
$pdo = new PDO('mysql:host=localhost;dbname=wf3_connexion', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// récupération des arguments dans post fournis via notre requête ajax (variable param)
// écriture ternaire
$pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";
$mdp = (isset($_POST['mdp'])) ? $_POST['mdp'] : "";

/*
// écriture classique
if(isset($_POST['pseudo']))
{
    $pseudo = $_POST['pseudo'];
}
else
{
    $pseudo = "";
}
*/

// déclaration d'un tableau array qui contiendra notre réponse à la requête ajax
$tab = array();

// déclaration de l'indice du tableau qui contiendra la réponse, c'est cet indice que l'on appelle dan sl'évènement onreadystatechange
$tab['resultat'] = "";

// EXERCICE: 
// Faire le contrôle si le pseudo et le mot de passe correspond à une entrée de la BDD
// s'il y a une erreur: renvoyer une chaîne de caractère annonçant l'erreur à l'utilisateur
// si le pseudo et le mdp sont ok envoyer un message du type 'Vous êtes connecté, vous êtes 'pseudo', de sexe 'sexe' et votre adresse mail est 'email'.

$verif_connexion = $pdo->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp');
$verif_connexion->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
$verif_connexion->bindParam(':mdp', $mdp, PDO::PARAM_STR);
$verif_connexion->execute();

$tab['resultat'] = $verif_connexion->fetch(PDO::FETCH_ASSOC);

if(!empty($tab['resultat'])) // si nous récupérons qq chose de la bdd
{
    // condition ternaire sur le sexe
    $sexe = ($tab['resultat']['sexe'] == 'm') ? 'masculin' : 'féminin';

    $tab['resultat'] = '<p style="color: green;">Vous êtes connectés, vous êtes ' . $tab['resultat']['pseudo'] . ', de sexe ' . $sexe . ' et votre adresse mail est ' . $tab['resultat']['email'] . '.</p>';
}
else
{
    $tab['resultat'] = '<p style="color: red;">Vos identifiants sont incorrects veuillez vérifier votre saisie</p>';
}

// envoi de la réponse en encodant sous le format JSON
echo json_encode($tab);