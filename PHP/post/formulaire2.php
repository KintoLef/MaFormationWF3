<?php
// sur formulaire2.php: mettre en place un formulaire avec deux champs (pseudo & email) + un bouton de validation
// ce formulaire doit envoyer les informations saisies sur la page formulaire2_resultat.php
// faites en sorte d'afficher les informations reçues (var_dump ou print_r)
// ensuite afficher proprement les informations saisies
// Attention en cas d'erreur, par exemple si j'arrive directement sur formulaire2_resultat.php sans être passé par la validation du formulaire, y-a-t'il des erreurs ?
// Pour aller plus loin tester la taille du pseudo: le pseudo doit avoir entre 4 et 14 caractères inclus.
// Si la taille est ok: on affiche le pseudo est: ...etc
// S'il y a une erreur sur la taille du pseudo on affiche un message à l'utilisateur
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * {font-family: sans-serif;}
        form {width: 40%; margin: 0 auto;}
        label {display: inline-block; width: 120px; font-style: italic;}
        input {height: 30px; border: 1px solid #EEE; width: 100%; resize: none;}
    </style>
</head>
<body>
    <form method="post" action="formulaire2_resultat.php" enctype="multipart/form-data">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="" required/>

        <label for="email">Email</label>
        <input type="text" name="email" id="email" value="" required/>

        <input type="submit" id="submit" value="Valider" />
    </form>
</body>
</html>