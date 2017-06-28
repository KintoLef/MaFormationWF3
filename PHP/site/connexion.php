<?php
require("inc/init.inc.php");

if(isset($_GET['action']) && $_GET['action'] == 'deconnexion')
{
    session_destroy();
}

// vérification si l'utilisateur est connecté si oui on le redirige sur profil.php
if(utilisateur_connecte())
{
    header('location:profil.php');
}

// vérification de l'existence des indices du formulaire
if(isset($_POST['pseudo']) && isset($_POST['mdp']))
{
    $pseudo = $_POST['pseudo'];
    $mdp = $_POST['mdp'];

    $verif_connexion = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp");
    $verif_connexion->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $verif_connexion->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $verif_connexion->execute();

    if($verif_connexion->rowCount() > 0)
    {
        // si nous avons 1 ligne alors le pseudo et le mdp sont corrects
        $info_utilisateur = $verif_connexion->fetch(PDO::FETCH_ASSOC);
        
        // on place toutes les informations de l'utilisateur dans la session sauf le mdp
        $_SESSION['utilisateur'] = array();
        $_SESSION['utilisateur']['id_membre'] = $info_utilisateur['id_membre'];
        $_SESSION['utilisateur']['pseudo'] = $info_utilisateur['pseudo'];
        $_SESSION['utilisateur']['nom'] = $info_utilisateur['nom'];
        $_SESSION['utilisateur']['prenom'] = $info_utilisateur['prenom'];
        $_SESSION['utilisateur']['email'] = $info_utilisateur['email'];
        $_SESSION['utilisateur']['sexe'] = $info_utilisateur['sexe'];
        $_SESSION['utilisateur']['ville'] = $info_utilisateur['ville'];
        $_SESSION['utilisateur']['cp'] = $info_utilisateur['cp'];
        $_SESSION['utilisateur']['adresse'] = $info_utilisateur['adresse'];
        $_SESSION['utilisateur']['statut'] = $info_utilisateur['statut'];

        header('location:profil.php');

        // même chose avec un foreach
        // $_SESSION['utilisateur'] = array();
        // foreach($info_utilisateur AS $indice => $valeur)
        // {
        //     if($indice != 'mdp')
        //     {
        //         $_SESSION['utilisateur'][$indice] = $valeur;
        //     }            
        // }
    }
    else {
        $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, les informations saisies sont erronées !!</div>';
    }
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>

    

    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: #00BA67;"></span> Connexion</h1>
        <?php // echo $message; // message destinés à l'utilisateur ?>
        <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
      </div>
      <div class="row">
        <div class="col-sm-5 col-sm-offset-3">
          <form class="form-horizontal" method="post" action="">
            <div class="form-group">
              <label for="pseudo" class="col-sm-4 control-label">Pseudo</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="">
              </div>
            </div>
            <div class="form-group">
              <label for="mdp" class="col-sm-4 control-label">Mot de Passe</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="mdp" id="mdp" placeholder="Password" value="">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-10">
                <button type="submit" class="btn btn-primary" name="connexion" id="connexion" style="background-color: #00BA67; border: 1px solid #B21428"><span class="glyphicon glyphicon-thumbs-up"></span> Se Connecter</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");