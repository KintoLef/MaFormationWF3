<?php
require_once('inc/init.inc.php');

$tab = array();
$tab['resultat'] = "";
// rajout d'un indice dan sle tableau array qui sera renvoyé nous permettant de faire un contrôle sur la disponibilité du pseudo
$tab['pseudo'] = 'disponible';

// variable de contrôle en cas d'erreur
$erreur= false;

$pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : "";
$sexe = (isset($_POST['sexe'])) ? $_POST['sexe'] : "";
$ville = (isset($_POST['ville'])) ? $_POST['ville'] : "";
$date_naissance = (isset($_POST['date_naissance'])) ? $_POST['date_naissance'] : "";

// requête de BDD pour vérifier si le pseudo existe déjà
$resultat = $pdo->prepare('SELECT * FROM membre WHERE pseudo = :pseudo');
$resultat->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
$resultat->execute();
// fetch
$membre = $resultat->fetch(PDO::FETCH_ASSOC);

// vérification si le pseudo existe déjà
if($resultat->rowCount() === 0)
{
    // ici le pseudo n'existe pas car nous n'avons pas récupéré au moins une ligne
    $inscription = $pdo->prepare("INSERT INTO membre (pseudo, sexe, ville, date_de_naissance, ip, date_connexion) VALUES (:pseudo, :sexe, :ville, :date_de_naissance, :ip, NOW())");
    $inscription->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $inscription->bindParam(':sexe', $sexe, PDO::PARAM_STR);
    $inscription->bindParam(':ville', $ville, PDO::PARAM_STR);
    $inscription->bindParam(':date_de_naissance', $date_naissance, PDO::PARAM_STR);
    $inscription->bindParam(':ip', $_SERVER['REMOTE_ADDR'], PDO::PARAM_STR); // $_SERVER['REMOTE_ADDR'] => adresse ip de l'utilisateur
    $inscription->execute();

    // on récupère l'id inséré pour le placer dans un deuxième temps dans la session
    $id_membre = $pdo->lastInsertId();
}
elseif($resultat->rowCount() > 0 && $membre['ip'] == $_SERVER['REMOTE_ADDR'])
{
    // si rowCount() > 0 alors le pseudo existe mais il est possible que ce soit la même personne. On compare donc l'adresse ip en cours ($_SERVER['REMOTE_ADDR']) avec l'adresse ip enregistrée dans la BDD ($membre['ip'])
    $id_membre = $membre['id_membre'];
    // on met à jour la date de connexion
    $pdo->query("UPDATE membre SET date_connexion = NOW() WHERE id_membre = $id_membre");
}
else
{
    // si on rentre dans ce else, le pseudo existe déjà et l'adresse ip n'est pas la même que celle pré-enregistrée
    $tab['resultat'] = "<p style='color: red;'>Ce pseudo est déjà utilisé, veuillez changer votre saisie</p>";
    // on change la valeur de la variable $erreur nous permettant de tester dans ce script s'il y a eu une erreur
    $erreur = true;
    // on change la valeur de $tab['pseudo'] afin de savoir s'il y a une erreur via javascript sur index.php
    $tab['pseudo'] = 'réservé';
}

// vérification s'il n'y a pas eu d'erreur au préalable
if(!$erreur)
{
    // on inscrit dans la session des informations sur l'utilisateur
    $_SESSION['utilisateur'] = array();
    $_SESSION['utilisateur']['pseudo'] = $pseudo;
    $_SESSION['utilisateur']['sexe'] = $sexe;
    $_SESSION['utilisateur']['id_membre'] = $id_membre;

    // création d'un fichier pour inscrire les utilisateurs présent sur le tchat
    $f = fopen('pseudo.txt', 'a');
    if(filesize('pseudo.txt') === 0) // avant d'enregistrer l'information, on regarde si le fichier à une taille = à 0, si c'est le cas alors c'est la 1ère ligne du fichier.
    {
        fwrite($f, $pseudo);
    }
    else
    {
        // si on rentre ici, alors des pseudos sont déjà inscrits donc on commence par sauter une ligne
        fwrite($f, "\n" . $pseudo);
    }
}

// envoi de la réponse en encodant sous le format JSON
echo json_encode($tab);