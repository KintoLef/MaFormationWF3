<meta charset='utf-8' />
<style>
    * {font-family: sans-serif;}
    h1{padding: 10px; background-color: navy; color: white;}
    .erreur{background-color: darkred; color: white; text-align: center;}
    .success{background-color: green; color: white; text-align: center;}
</style>


<?php
    echo '<pre>'; print_r($_POST); echo '</pre>';

    if(isset($_POST['pseudo']) && (iconv_strlen($_POST['pseudo'])>3 && iconv_strlen($_POST['pseudo'])<15) && (isset($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)))
    {
        echo "Le pseudo est: " . $_POST['pseudo'] . "<br />";
        echo "L'email est: " . $_POST['email'] . "<br />";
    } else {
        echo 'Vous n\'avez pas renseigner vos informations correctement, veuillez retourner à la page précédente.<br />';
    }
    echo "<a href='formulaire2.php'>Retour au formulaire</a>";

// AUTRE FACON DE FAIRE:
$message = '';

    if(isset($_POST['pseudo']) && isset($_POST['email']))
    {
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];

        // contrôle sur la taille du pseudo
        if(iconv_strlen($pseudo)>3 && iconv_strlen($pseudo)<15)
        {
            $message .= '<p class="success">Votre pseudo est: ' . $pseudo . '</p>'; 
        } else {
            // il y a un souci sur la taille du pseudo
            $message .= '<p class="erreur">Attention, la taille du pseudo est invalide<br />En effet, le pseudo doit avoir entre 4 et 14 caractères inclus</p>';
        }

        // contrôle sur la validité de l'email
        if(filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $message .= '<p class="success">Votre email est: ' . $email . '</p>'; 
        } else {
            // il y a un souci sur la taille du pseudo
            $message .= '<p class="erreur">Attention, le format de l\'email est invalide</p>';
        }
    }

echo '<h1>Résultats</h1>';

echo $message;
?>