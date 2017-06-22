<?php
// récupération du choix de l'utilisateur ou cas par défaut
if(isset($_GET['langue']))
{
    $langue = $_GET['langue']; // choix de l'utilisateur
}
elseif(isset($_COOKIE['langue']))
{
    $langue = $_COOKIE['langue'];
}
else {
    $langue = 'fr'; // cas par défaut
    // $langue = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2); //cas par défaut
}

// nombre de secondes dans un an
$un_an = 365*24*3600; // nbr de jour * nbr d'h * nbr de sec

// création d'un cookie sur le poste utilisateur
// /!\ la fonction setCookie() doit être appelé avant le moindre affichage dans la page !!!!
// pour générer un cookier: 3 arguments setCookie(nom, valeur, durée de vie)
setCookie('langue', $langue, time()+$un_an)

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Cookie</title>
    </head>
    <body>
        <ul>
            <li><a href="?langue=fr">France</a></li>
            <li><a href="?langue=es">Espagne</a></li>
            <li><a href="?langue=it">Italie</a></li>
            <li><a href="?langue=en">Angleterre</a></li>
        </ul>

        <?php
            // affichage d'un texte selon la langue
            switch($langue) // on teste la valeur de $langue
            {
                case 'fr':
                    echo '<p>Bonjour !! <br />Vous visitez le site en langue française</p>';
                break;
                case 'es':
                    echo '<p>Holà !! <br />Vous visitez le site en langue espagnole</p>';
                break;
                case 'it':
                    echo '<p>Ciao !! <br />Vous visitez le site en langue italienne</p>';
                break;
                case 'en':
                    echo '<p>Hello !! <br />Vous visitez le site en langue anglaise</p>';
                break;
                default:
                    echo '<p>Langue inconnue !!</p>';
                break;
            }

            // echo '<pre>', print_r($_SERVER); echo '</pre>';
            // il est possible de récupérer la langue du navigateur de l'utilisateur
            echo 'langue du navigateur: ' . substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) . '<br />';
            echo time(); // time() affiche la valeur du timestamp
            echo '<pre>'; print_r($_COOKIE); echo '</pre>';


            
        ?>

    </body>
</html>