<?php
require("inc/init.inc.php");

// vérification si l'utilisateur est connecté sinon on le redirige sur connexion.php
if(!utilisateur_connecte())
{
    header('location:connexion.php');
}

if($_SESSION['utilisateur']['statut'] == 1)
{
    $role = '(administrateur)';
} else {
    $role = '(membre)';
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>

    

    <div class="container">

        <div class="starter-template">
            <h1><span class="glyphicon glyphicon-user" style="color: #00BA67;"></span> Profil <?php echo $role ?></h1>
            <?php // echo $message; // message destinés à l'utilisateur ?>
            <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <h2><?php echo 'Bonjour ' . $_SESSION['utilisateur']['prenom'] . ' ' . $_SESSION['utilisateur']['nom'] . ' !' ?></h2>
                <div class="col-sm-10" style="background: url('http://wallpapercave.com/wp/tqyeBQZ.jpg') top center /cover no-repeat; border-radius: 3px; border: 1px solid #AAA;">
                    <h3 style="color: white;">Informations:</h3>
                    <ul class="list-group">
                        <li class="list-group-item">Pseudo: <?php echo $_SESSION['utilisateur']['pseudo'] ?></li>
                        <li class="list-group-item">Nom: <?php echo $_SESSION['utilisateur']['nom'] ?></li>
                        <li class="list-group-item">Prénom: <?php echo $_SESSION['utilisateur']['prenom'] ?></li>
                        <li class="list-group-item">Email: <?php echo $_SESSION['utilisateur']['email'] ?></li>
                        <li class="list-group-item">Sexe: <?php echo $_SESSION['utilisateur']['sexe'] ?></li>
                        <li class="list-group-item">Adresse: <?php echo $_SESSION['utilisateur']['adresse'] . ' ' . $_SESSION['utilisateur']['cp'] . ' ' . $_SESSION['utilisateur']['ville'] ?></li>
                    </ul>

                </div>
            </div>
            <div class="col-sm-4">
                <img src="img/marty_profil.gif" class="img-responsive img-rounded" alt="" style="margin-top: 20px; height: 368px; border: 1px solid #DDD;">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">

            </div>
        </div>
      

    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");