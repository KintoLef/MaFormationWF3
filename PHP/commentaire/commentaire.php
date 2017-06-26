<?php
// ici nous allons avoir un formulaire permettant à l'utilisateur d'écrire un commentaire. Il faudra enregistrer ce commentaire en BDD pour l'afficher ensuite dans la page.

// 1. Faire un formulaire avec ces champs:
    // pseudo (type text)
    // commentaire (type textarea)

// 2. Récupération des saisies et affichage sur la même page

// 3. Insertion des données dans la BDD

// 4. Affichage des commentaires dans la page (récupération depuis BDD traitement)

// 5. Afficher les derniers commentaires (enregistrés) en premier dans la page

// 6. Afficher le nombre de commentaires

// 7. Afficher la date et l'heure du commentaire (en français)

// BONUS - CSS

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Commentaire</title>
    <style>
        * {font-family: calibri;}
        form {width: 25%; min-width: 200px; margin: 0 auto;}
        input {width: 100%; border: 1px solid #096514; border-radius: 2px; height: 30px;}
        textarea {width: 100%; border: 1px solid #096514; border-radius: 2px; resize: vertical;}
        input[type='submit'] {background-color: #096514; color: white; width: 100%; margin: 0 auto;}
    </style>
</head>
<body>
   
   
    <?php
    echo '<pre>'; print_r($_POST); echo '<pre>';
    // connexion à la BDD
    $pdo = new PDO('mysql:host=localhost;dbname=wf3_commentaire', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    if(isset($_POST['pseudo']) && isset($_POST['message']))
    {
        $pseudo = $_POST['pseudo'];
        $message = $_POST['message'];
        
        $insert_comment_bdd = $pdo->prepare("INSERT INTO commentaire (id_commentaire, pseudo, message, date) VALUES (NULL, :pseudo, :message, CURRENT_TIMESTAMP)");
        $insert_comment_bdd->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
        $insert_comment_bdd->bindParam(':message', $message, PDO::PARAM_STR);
        $insert_comment_bdd->execute();
    }
    ?>


    <hr />
    <form action="#" method="post">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" />

        <label for="message">Message</label>
        <textarea name="message" id="message" rows="5" cols="25"></textarea>

        <input type="submit" value="Publier" />
    </form>
    <hr />

    <?php
    $liste_comment = $pdo->query("SELECT * FROM commentaire ORDER BY date DESC");
    echo 'Nombre de Commentaires: ' . $liste_comment->rowCount() . '<br />';

    while($commentaire = $liste_comment->fetch(PDO::FETCH_NUM))
    {
        echo '<div style="box-sizing: border-box; padding: 10px; border: 1px solid #999; border-radius: 3px; background-color: #EEE; color: black; width: 23%; margin: 1% auto;">';

        echo 'Commentaire N°: ' . $commentaire[0] . '<hr />';
        echo 'Pseudo: ' . $commentaire[2] . '<hr />';
        echo 'Message: ' . $commentaire[1] . '<hr />';
        echo 'Publié le: ' . $date_publication = date("d-m-Y H:i:s", strtotime($commentaire[3])) . '<br />';

        echo '</div>';
    }

    $nb_comment = $pdo->query("SELECT COUNT(*) FROM commentaire");
    $text = $nb_comment->fetch(PDO::FETCH_NUM);
    echo $text[0];
    ?>

</body>
</html>