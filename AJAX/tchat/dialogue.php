<?php
require_once('inc/init.inc.php');
if(empty($_SESSION['utilisateur']['pseudo']))
{
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="css/style.css">
        <title>Dialogue</title>
    </head>
    <body>
        <div id="conteneur">
            <h2 id="moi">Bonjour <?php echo $_SESSION['utilisateur']['pseudo']; ?></h2>
            <div id="message_tchat"></div>
            <div id="liste_membre_connecte"></div>
            <div class="clear"></div>
            <div id="smiley">
                <?php
                    for($i=1; $i<=28; $i++)
                    {
                        echo "<img class='smiley' src='smil/smiley" . $i . ".gif' alt=':)'>";
                    }
                ?>                
            </div>
            <!-- FORMULAIRE -->
            <div id="formulaire_tchat">
                <form action="" method="post" id="form">
                    <textarea id="message" name="message" rows="5" maxlength="300"></textarea><br>
                    <input type="submit" name="envoi" value="Envoi" class="submit">
                </form>
            </div>
            <div id="postMessage"></div>
        </div>
        <script src="js/dialogue.js"></script>
    </body>
</html>