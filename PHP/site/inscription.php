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
  // si le formulaire a été validé, on place dans ces variables les saisies correspondantes
  $pseudo = $_POST['pseudo'];
  $mdp = $_POST['mdp'];
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $sexe = $_POST['sexe'];
  $ville = $_POST['ville'];
  $cp = $_POST['cp'];
  $adresse = $_POST['adresse'];

  // variable de contrôle des erreurs
  $erreur = "";

  // contrôle sur la taille du pseudo
  if(iconv_strlen($pseudo)<4 || iconv_strlen($pseudo)>14)
  {
    $message = '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, la taille du pseudo est invalide<br />En effet, le pseudo doit avoir entre 4 et 14 caractères inclus</div>';
    $erreur = true; // si l'on rentre dans cette condition alors il y a une erreur
  }

  // contrôle des caractères dans le pseudo (autorisées: a-z A-Z 0-9 _ - .)
  $verif_caracteres = preg_match('#^[a-zA-Z0-9._-]+$#', $pseudo);
  /*
    preg_match() va vérifier les caractères contenus dans la variable pseudo selon une expression régulière fournie en 1er argument.
    -> renvoie 1 si tout est ok sinon 0

    expression:
    # -> permet d'indiquer le début et la fin de l'expression
    ^ -> indique que la chaîne($pseudo) ne peut commencer que par ces caractères
    $ -> indique que la chaîne($pseudo) ne peut finir que par ces caractères
    + -> indique que les caractères autorisés peuvent apparaître plusieurs fois
    []-> contient les caractères autorisés
  */

  if(!$verif_caracteres && !empty($pseudo))
  {
    // on rentre dans cette condition si $verif_caracteres contient 0 donc s'il y a des caracteres non autorisés
    $message = '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, caractères non autorisés dans le pseudo<br />Caractères autorisés: a-z et 0-9</div>';
    $erreur = true;
  }

  // contrôle sur la validité du format de l'email
  $verif_mail = filter_var($email, FILTER_VALIDATE_EMAIL);

  if(!$verif_mail && !empty($email))
  {
    // on rentre dans cette condition si $verif_caracteres contient 0 donc s'il y a des caracteres non autorisés
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le format de l\'email n\'est pas valide</div>';
    $erreur = true;
  }

  // contrôle sur la disponibilité du pseudo
  $dispo_pseudo = $pdo->prepare("SELECT * FROM membre WHERE pseudo = :pseudo");
  $dispo_pseudo->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
  $dispo_pseudo->execute();

  if($dispo_pseudo->rowCount()>0)
  {
    // si l'on obtient au moins 1 ligne de resultat alors le pseudo est déjà pris.
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, le pseudo est déjà pris, veuillez changer votre saisie</div>';
    $erreur = true;

  }
  // insertion dans la BDD
  if($erreur !== true) // si $erreur est différent de true lors les contrôles préalables sont ok
  {
    // pour crypter(hashage) le mot de passe
    // $mdp = password_hash($mdp, PASSWORD_DEFAULT); -> pour voir la gestion du mdp lors de la connexion, voir le fichier connexion_avec_mdp_hash.php
    $enregistrement = $pdo->prepare("INSERT INTO membre(pseudo, mdp, nom, prenom, email, sexe, ville, cp, adresse, statut) VALUES(:pseudo, :mdp, :nom, :prenom, :email, :sexe, :ville, :cp, :adresse, 0)");
    $enregistrement->bindParam(":pseudo", $pseudo, PDO::PARAM_STR);
    $enregistrement->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $enregistrement->bindParam(":nom", $nom, PDO::PARAM_STR);
    $enregistrement->bindParam(":prenom", $prenom, PDO::PARAM_STR);
    $enregistrement->bindParam(":email", $email, PDO::PARAM_STR);
    $enregistrement->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $enregistrement->bindParam(":ville", $ville, PDO::PARAM_STR);
    $enregistrement->bindParam(":cp", $cp, PDO::PARAM_STR);
    $enregistrement->bindParam(":adresse", $adresse, PDO::PARAM_STR);
    $enregistrement->execute();
    // on redirige sur la page connexion.php
    header("location:connexion.php");
  }
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
          <form class="form-inline" method="post" action="">
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









