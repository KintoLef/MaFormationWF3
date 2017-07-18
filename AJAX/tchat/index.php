<?php
require_once('inc/init.inc.php');
if(!empty($_SESSION['utilisateur']['pseudo']))
{
    // header('location:dialogue.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Accueil - Connexion</title>
    </head>
    <body>
        <div class="contenu">
            <fieldset>
                <div id="message">
                    Bonjour veuillez vous connecter pour accéder au tchat
                </div>
            </fieldset>
            <fieldset>
                <form action="#" method="post" id="form">
                    <!-- dans ce formulaire 4 champs + bouton submit (pseudo / sexe / ville / date_naissance) -->
                    <label for="pseudo">Pseudo</label>
                    <input type="text" id="pseudo" name="pseudo">

                    <label for="sexe">Sexe</label>
                    <select id="sexe" name="sexe">
                        <option value="m">Homme</option>
                        <option value="f">Femme</option>
                    </select>

                    <label for="ville">Ville</label>
                    <input type="text" id="ville" name="ville">

                    <label for="date_naissance">Date de Naissance</label>
                    <input type="date" id="date_naissance" name="date_naissance" value="" placeholder="AAAA/MM/JJ">
                    <br>
                    <br>
                    <input type="submit" value="Valider">
                </form>
            </fieldset>
        </div>
        <script src="js/index.js"></script>
    </body>
</html>