<?php
    echo '<pre>'; print_r($_POST); echo '</pre>';

    if(isset($_POST['pseudo']) && (iconv_strlen($_POST['pseudo'])>3 && iconv_strlen($_POST['pseudo'])<15) && (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
    {
        echo "Le pseudo est: " . $_POST['pseudo'] . "<br />";
        echo "L'email est: " . $_POST['email'] . "<br />";
    } else {
        echo 'Vous n\'avez pas renseigner vos informations correctement, veuillez retourner à la page précédente.<br />';
    }
    echo "<a href='formulaire2.php'>Retour au formulaire</a>"
?>