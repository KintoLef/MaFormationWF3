<?php
// $_POST est une superglobale donc un tableau ARRAY
// $_POST est toujours existant mais par défaut est vide !
// $_POST nous permet de récupérer les informations provenant d'un formulaire
// l'indice correspondant à la saisie d'un champ sera l'attribut name='' du champ
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <style>
        * {font-family: sans-serif;}
        form {width: 40%; margin: 0 auto;}
        label {display: inline-block; width: 120px; font-style: italic;}
        input, textarea {height: 30px; border: 1px solid #EEE; width: 100%; resize: none;}
        textarea {height: 60px;}
    </style>
</head>
<body>
<?php
    echo '<pre>'; print_r($_POST); echo '</pre>';
?>
    <form method="post" action="" enctype="multipart/form-data">
        <label for="pseudo">Pseudo</label>
        <input type="text" name="pseudo" id="pseudo" value="" />

        <label for="message">Message</label>
        <textarea name="message" id="message"></textarea><br />

        <input type="submit" id="submit" value="Valider" />
    </form>
<?php
    if(isset($_POST['pseudo']) && isset($_POST['message']))
    {
        echo "Le pseudo est: " . $_POST['pseudo'] . "<br />";
        echo "Le message est: " . $_POST['message'] . "<br />";
    }
?>
</body>
</html>