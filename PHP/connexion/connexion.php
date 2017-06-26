<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>

    <style>
        * {font-family: calibri;}
        form {width: 25%; min-width: 200px; margin: 0 auto;}
        input {width: 100%; border: 1px solid #EEE; border-radius: 2px; height: 30px;}
        form hr {border: 0px;}
    </style>
</head>
<body>
    <?php
    echo '<pre>'; print_r($_POST); echo '<pre>';
    // connexion à la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=wf3_connexion', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    if(isset($_POST['pseudo']) && isset($_POST['mdp']))
    {
        $pseudo = $_POST['pseudo'];
        $mdp = $_POST['mdp'];

        // récupération des informations en ajoutant la fonction prédéfinie addslashes() pour gérer les quotes et guillemets
        // $pseudo = addslashes($_POST['pseudo']);
        // $mdp = addslashes($_POST['mdp']);

        echo '<b>Pseudo:</b> ' . $pseudo . '<br/>';
        echo '<b>Mot de Passe:</b> ' . $mdp . '<br/>';

        $req = "SELECT * FROM utilisateur WHERE pseudo = '$pseudo' AND mdp = '$mdp'";
        echo '<b>Requête:</b> ' . $req . '<br />'; // affichage de la requête pour comprendre les injections

        // execution de la requête
        // $resultat = $pdo->query($req);
        // la ligne au dessus permet l'injection de code via le formulaire (injections sql notamment), pour sécuriser, il nous suffit d'utliser prepare + execute
        $resultat = $pdo->prepare('SELECT * FROM utilisateur WHERE pseudo = :pseudo AND mdp = :mdp');
        $resultat->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $resultat->bindParam(':mdp', $mdp, PDO::PARAM_STR);
        $resultat->execute();

        $membre = $resultat->fetch(PDO::FETCH_ASSOC);

        if(!empty($membre)) // si nous récupérons qq chose de la bdd
        {
            // alors le pseudo et le mdp sont correct
            echo '<h1 style="background-color: green; color: white; padding: 10px;">Vous êtes connecté</h1>';
            echo '<b>Vos informations:</b><br />';
            echo '<b>id_utilisateur:</b> ' . $membre['id_utilisateur'] . '<br />';
            echo '<b>Pseudo:</b> ' . $membre['pseudo'] . '<br />';
            echo '<b>Mot de Passe:</b> ' . $membre['mdp'] . '<br />';
            echo '<b>Sexe:</b> ' . $membre['sexe'] . '<br />';
            echo '<b>Email:</b> ' . $membre['email'] . '<br />';
            echo '<b>Adresse:</b> ' . $membre['adresse'] . '<br />';
        }
        else
        {
            echo '<h1 style="background-color: red; color: white; padding: 10px;">Erreur, le pseudo et/ou le mot de passe sont invalides</h1>';
        }
    }

    ?>
    <hr />
    <form action="#" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" />

        <label for="mdp">Mot de Passe</label>
        <input type="text" name="mdp" id="mdp" /><hr />

        <input type="submit" value="Connexion" />
    </form>
    <hr />
</body>
</html>

