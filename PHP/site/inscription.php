<?php
require("inc/init.inc.php");

$pseudo = "";
$mdp = "";
$nom = "";
$prenom = "";
$email = "";
$sexe = "";
$ville = "";
$cp = "";
$adresse = "";

// contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['sexe']) && isset($_POST['ville']) && isset($_POST['cp']) && isset($_POST['adresse']))
{
  $pseudo = $_POST['pseudo'];
  $mdp = $_POST['mdp'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $sexe = $_POST['sexe'];
  $ville = $_POST['ville'];
  $cp = $_POST['cp'];
  $adresse = $_POST['adresse'];
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
echo '<pre>'; print_r($_POST); echo '</pre>';
?>

    

    <div class="container">

      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-user" style="color: #00BA67;"></span> Inscription</h1>
        <?php // echo $message; // message destinés à l'utilisateur ?>
        <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
      </div>

      <div class="row">
        <div class="col-sm-5 col-sm-offset-3">
          <form class="form-horizontal" method="post" action="">
            <div class="form-group">
              <label for="pseudo" class="col-sm-4 control-label">Pseudo</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="pseudo" id="pseudo" placeholder="Pseudo" value="<?php echo $pseudo ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="mdp" class="col-sm-4 control-label">Mot de Passe</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="mdp" id="mdp" placeholder="Password" value="<?php echo $mdp ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="nom" class="col-sm-4 control-label">Nom</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="nom" id="nom" placeholder="Nom" value="<?php echo $nom ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="prenom" class="col-sm-4 control-label">Prénom</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Prenom" value="<?php echo $prenom ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="email" class="col-sm-4 control-label">E-mail</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="email" id="email" placeholder="example@mail.com" value="<?php echo $email ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="sexe" class="col-sm-4 control-label">Sexe</label>
              <div class="col-sm-8">
                <select class="form-control" name="sexe" id="sexe">
                  <option value="m">Homme</option>
                  <option value="f" <?php if($sexe == 'f') {echo 'selected';} ?> >Femme</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="ville" class="col-sm-4 control-label">Ville</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="ville" id="ville" placeholder="Ville" value="<?php echo $ville ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="cp" class="col-sm-4 control-label">Code Postal</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="cp" id="cp" placeholder="CP" value="<?php echo $cp ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="adresse" class="col-sm-4 control-label">Adresse</label>
              <div class="col-sm-8">
               <textarea class="form-control" name="adresse" id="adresse" cols="41" rows="4" style="resize: none;"><?php echo $adresse ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-10">
                <button type="submit" class="btn btn-primary" name="inscription" id="inscription" style="background-color: #00BA67; border: 1px solid #B21428"><span class="glyphicon glyphicon-pencil"></span> Inscription</button>
              </div>
            </div>
          </form>
        </div>
      </div>

    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");









