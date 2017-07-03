<?php
require("../inc/init.inc.php");

// restriction d'accès, si l'utilisateur n'est pas admin alors il ne doit pas accéder à cette page
if(!utilisateur_admin())
{
    header('location:../connexion.php');
    exit(); // permet d'arrêter l'éxécution du script au cas où une personne malveillante ferait des injections via GET
}

// mettre en place un contrôle pour savoir si l'utilisateur veut une suppression d'un produit.
if(isset($_GET['action']) && $_GET['action'] == 'suppr' && !empty($_GET['id_article']) && is_numeric($_GET['id_article']))
{
  // is_numeric() permet de savoir si l'information est bien une valeur numérique sans tenir compte de son type (les informations provenant de GET et de POST sont toujours de type string)

  // on fait une requête pour récupérer les informations de l'article afin de connaître la photo pour la supprimer
  $id_article = $_GET['id_article'];
  $article_a_supprim = $pdo->prepare('SELECT * FROM article WHERE id_article = :id_article');
  $article_a_supprim->bindParam(':id_article', $id_article, PDO::PARAM_STR);
  $article_a_supprim->execute();

  $article_a_suppr = $article_a_supprim->fetch(PDO::FETCH_ASSOC);
  // on vérifie si la photo existe
  if(!empty($article_a_suppr['photo']))
  {
    // on vérifie le chemin si le fichier existe
    $chemin_photo = RACINE_SERVER . 'photo/' . $article_a_suppr['photo'];
    // $message .= $chemin_photo;

    if(file_exists($chemin_photo))
    {
      unlink($chemin_photo); // unlink() permet de supprimer un fichier sur le serveur
    }
  }

  $suppression = $pdo->prepare('DELETE FROM article WHERE id_article = :id_article');
  $suppression->bindParam(':id_article', $id_article, PDO::PARAM_STR);
  $suppression->execute();

  $message .= '<div class="alert alert-success" role="alert" style="margin-top: 20px;">L\'article n°' . $id_article . ' a bien été supprimé</div>';

  // on bascule sur l'affichage du tableau
  $_GET['action'] = 'affichage';

}

$id_article = "";
$reference = "";
$categorie = "";
$titre = "";
$description = "";
$couleur = "";
$taille = "";
$sexe = "";
$photo_bdd = "";
$prix = "";
$stock = "";

// variable de contrôle des erreurs
$erreur = "";

// *************************************************************
// RECUPERATION DES INFORMATIONS D'UN ARTICLE A MODIFIER
// *************************************************************

if(isset($_GET['action']) && $_GET['action'] == 'modif' && !empty($_GET['id_article']) && is_numeric($_GET['id_article']))
{
  $id_article = $_GET['id_article'];
  $article_a_modifier = $pdo->prepare('SELECT * FROM article WHERE id_article = :id_article');
  $article_a_modifier->bindParam(':id_article', $id_article, PDO::PARAM_STR);
  $article_a_modifier->execute();

  $article_actuelle = $article_a_modifier->fetch(PDO::FETCH_ASSOC);

  $id_article = $article_actuelle['id_article'];
  $reference = $article_actuelle['reference'];
  $categorie = $article_actuelle['categorie'];
  $titre = $article_actuelle['titre'];
  $description = $article_actuelle['description'];
  $couleur = $article_actuelle['couleur'];
  $taille = $article_actuelle['taille'];
  $sexe = $article_actuelle['sexe'];  
  $prix = $article_actuelle['prix'];
  $stock = $article_actuelle['stock'];

  $photo_actuelle = $article_actuelle['photo']; // on récupère la photo de l'article dans une nouvelle variable
}

//******************************************************************
//        ENREGISTREMENT DES ARTICLES
//******************************************************************

// contrôle sur l'existence de tous les champs provenant du formulaire (sauf le bouton de validation)
if(isset($_POST['reference']) && isset($_POST['categorie']) && isset($_POST['titre']) && isset($_POST['description']) && isset($_POST['couleur']) && isset($_POST['sexe']) && isset($_POST['taille']) && isset($_POST['prix']) && isset($_POST['stock']))
{
  // si le formulaire a été validé, on place dans ces variables les saisies correspondantes
  $id_article = $_POST['id_article'];
  $reference = $_POST['reference'];
  $categorie = $_POST['categorie'];
  $titre = $_POST['titre'];
  $description = $_POST['description'];
  $couleur = $_POST['couleur'];
  $sexe = $_POST['sexe'];
  $taille = $_POST['taille'];
  $prix = $_POST['prix'];
  $stock = $_POST['stock'];

  // contrôle sur la référence si on est dans le cas d'un ajout car lors d'une modif la référence existera toujours
  $dispo_ref = $pdo->prepare("SELECT * FROM article WHERE reference = :reference");
  $dispo_ref->bindParam(":reference", $reference, PDO::PARAM_STR);
  $dispo_ref->execute();

  if($dispo_ref->rowCount()>0 && isset($_GET['action']) && $_GET['action'] == 'ajout')
  {
    // si l'on obtient au moins 1 ligne de resultat alors le pseudo est déjà pris.
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, cette référence existe déjà, veuillez changer votre saisie</div>';
    $erreur = true;

  }

  // vérification si le titre n'est pas vide
  if(empty($titre))
  {
    $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, vous n\'avez pas renseigné de titre !!</div>';
    $erreur = true;
  }

  // récupération de l'ancienne photo (photo actuelle) dans le cas d'une modif
  if(isset($_GET['action']) && $_GET['action'] == 'modif')
  {
    if(isset($_POST['ancienne_photo']))
    {
      $photo_bdd = $_POST['ancienne_photo'];
    }
  }

  // vérification si l'utilisateur a chargé une image
  if(!empty($_FILES['photo']['name']))
  {
    // si ce n'est pas vide alors un fichier a bien été chargé via le formulaire

    // on concatène la référence sur le titre afin de ne jamais avoir un fichier avec un nom déjà existant sur le serveur
    $photo_bdd = $reference . '_' . $_FILES['photo']['name'];

    // vérification de l'extension de l'image (jpg, jpeg, png, gif)
    $extension = strrchr($_FILES['photo']['name'], '.'); // cette fonction prédéfinie permet de découper une chaîne selon le caractère fourni en 2ème argument ('.'). Attention, cette fonction découpera la chaîne à partir de la dernière occurance du 2ème argument.

    $extension = strtolower($extension); // on transforme $extension afin que tous les caractères soient en minuscule
    $extension = substr($extension, 1); // ex: .jpg -> jpg
    $tab_extension_valide = array('jpg', 'jpeg', 'png', 'gif'); // les extensions acceptées

    // on va maintenant vérifier l'extension
    $verif_extension = in_array($extension, $tab_extension_valide); // in_array vérifie si une valeur fournie en 1er argument fait partie des valeurs contenues dans un tableau array fournie en 2ème argument

    if($verif_extension && !$erreur)
    {
      // si $verif_extension est égal à true et que $erreur est égal à false (il n'y en a pas)
      $photo_dossier = RACINE_SERVER . 'photo/' . $photo_bdd;

      copy($_FILES['photo']['tmp_name'], $photo_dossier); // copy() permet de copier un fichier depuis un emplacement fourni en premier argument vers un autre emplacement fourni en deuxième argument
    }
    elseif(!$verif_extension)
    {
      $message .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Attention, l\'extension n\'est pas au bon format</div>';
      $erreur = true;
    }
  }

  // insertion dans la BDD
  if($erreur !== true) // si $erreur est différent de true lors les contrôles préalables sont ok
  {
    
    if(isset($_GET['action']) && $_GET['action'] == 'ajout')
    {
      // pour crypter(hashage) le mot de passe
      // $mdp = password_hash($mdp, PASSWORD_DEFAULT); -> pour voir la gestion du mdp lors de la connexion, voir le fichier connexion_avec_mdp_hash.php
      $enregistrement_produit = $pdo->prepare("INSERT INTO article(reference, categorie, titre, description, couleur, taille, sexe, prix, stock, photo) VALUES(:reference, :categorie, :titre, :description, :couleur, :taille, :sexe, :prix, :stock, :photo)");
    }
    elseif(isset($_GET['action']) && $_GET['action'] == 'modif')
    {
      $enregistrement_produit = $pdo->prepare("UPDATE article SET reference = :reference, categorie = :categorie, titre = :titre, description = :description, couleur = :couleur, taille = :taille, sexe = :sexe, prix = :prix, stock = :stock, photo = :photo WHERE id_article = :id_article");
      $id_article = $_POST['id_article'];
      $enregistrement_produit->bindParam(":id_article", $id_article, PDO::PARAM_STR);
    }


    $enregistrement_produit->bindParam(":reference", $reference, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":categorie", $categorie, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":titre", $titre, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":description", $description, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":couleur", $couleur, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":taille", $taille, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":sexe", $sexe, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":prix", $prix, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":stock", $stock, PDO::PARAM_STR);
    $enregistrement_produit->bindParam(":photo", $photo_bdd, PDO::PARAM_STR);
    $enregistrement_produit->execute();

    
  }

}

// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
// echo '<pre>'; print_r($_POST); echo '</pre>';
// echo '<pre>'; print_r($_FILES); echo '</pre>';
?>

    

    <div class="container">

      <div class="starter-template">
        <h1>Gestion Boutique</h1>
        <?php // echo $message; // message destinés à l'utilisateur ?>
        <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
        <hr>
        <a href="?action=ajout" class="btn btn-success">Ajouter un Produit</a>
        <a href="?action=affichage" class="btn btn-primary">Afficher les Produits</a>
      </div>

      <?php
      // affichage de tous les produits dans un tableau html
      // exercice: couper la description si elle est trop longue
      // exercice: afficher l'image dans une balise <img src="" />
      if(isset($_GET['action']) && $_GET['action'] == 'affichage')
      {
        $articles = $pdo->query('SELECT * FROM article');
        echo '<hr />';

        // balise ouverture du tableau
        echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';

            // première ligne du tableau pour le nom des colonnes
            echo '<tr>';

                // récupération du nombre de colonnes dans la requête:
                $nb_col = $articles->columnCount();

                for($i=0; $i<$nb_col; $i++)
                {
                    // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                    $colonne = $articles->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                    echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                }

                echo '<th style="padding: 10px; text-align: center;">Modifier</th>';
                echo '<th style="padding: 10px; text-align: center;">Supprimer</th>';
            echo '</tr>';

            while($ligne = $articles->fetch(PDO::FETCH_ASSOC))
            {
                echo '<tr>';

                foreach($ligne AS $indice => $article)
                {
                    if($indice == 'description')
                    {
                      echo '<td style="padding: 10px;">' . substr($article, 0, 43) . '</td>';
                    }
                    elseif($indice == 'photo')
                    {
                      echo '<td style="padding: 10px;"><img src="' . URL . 'photo/' . $article . '" width="120"></td>';
                    }
                    elseif($indice == 'prix')
                    {
                      echo '<td style="padding: 10px;">' . $article . '€</td>';
                    }
                    else
                    {
                      echo '<td style="padding: 10px;">' . $article . '</td>';
                    }

                    
                }
                echo '<td style="padding: 10px;"><a href="?action=modif&id_article=' . $ligne['id_article'] . '" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</a></td>';
                echo '<td style="padding: 10px;"><a onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet article\'));" href="?action=suppr&id_article=' . $ligne['id_article'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></td>';

                echo '</tr>';
            }

        echo '</table>';

      }

      ?>      
      
      <?php
      if(isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modif'))
      {
      ?>

      <div class="row">
        <div class="col-sm-5 col-sm-offset-1">
          <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
            <div class="form-group">
              <div class="col-sm-8">
                <!-- id_article caché via 'hidden' -->
                <input type="hidden" class="form-control" name="id_article" id="id_article" value="<?php echo $id_article ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="reference" class="col-sm-4 control-label">Référence</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="reference" id="reference" placeholder="Réf." value="<?php echo $reference ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="categorie" class="col-sm-4 control-label">Catégorie</label>
              <div class="col-sm-8">
                <select class="form-control" name="categorie" id="categorie">
                  <option value="vetement" <?php if($categorie == 'vetement') {echo 'selected';} ?> >Vêtements</option>
                  <option value="goodies" <?php if($categorie == 'goodies') {echo 'selected';} ?> >Goodies</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="titre" class="col-sm-4 control-label">Titre</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre" value="<?php echo $titre ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="description" class="col-sm-4 control-label">Description</label>
              <div class="col-sm-8">
               <textarea class="form-control" name="description" id="description" cols="41" rows="4" style="resize: none;"><?php echo $description ?></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="couleur" class="col-sm-4 control-label">Couleur</label>
              <div class="col-sm-8">
                <select class="form-control" name="couleur" id="couleur">
                  <option value=""></option>
                  <option value="noir" <?php if($couleur == 'noir') {echo 'selected';} ?> >Noir</option>
                  <option value="blanc" <?php if($couleur == 'blanc') {echo 'selected';} ?> >Blanc</option>
                  <option value="rouge" <?php if($couleur == 'rouge') {echo 'selected';} ?> >Rouge</option>
                  <option value="bleu" <?php if($couleur == 'bleu') {echo 'selected';} ?> >Bleu</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="taille" class="col-sm-4 control-label">Taille</label>
              <div class="col-sm-8">
                <select class="form-control" name="taille" id="taille">
                  <option value=""></option>
                  <option value="s" <?php if($taille == 's') {echo 'selected';} ?> >S</option>
                  <option value="m" <?php if($taille == 'm') {echo 'selected';} ?> >M</option>
                  <option value="l" <?php if($taille == 'l') {echo 'selected';} ?> >L</option>
                  <option value="xl" <?php if($taille == 'xl') {echo 'selected';} ?> >XL</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="sexe" class="col-sm-4 control-label">Sexe</label>
              <div class="col-sm-8">
                <select class="form-control" name="sexe" id="sexe">
                  <option value=""></option>
                  <option value="m" <?php if($sexe == 'm') {echo 'selected';} ?> >Homme</option>
                  <option value="f" <?php if($sexe == 'f') {echo 'selected';} ?> >Femme</option>
                </select>
              </div>
            </div>

            <?php
            // affichage de la photo actuelle dans le cas d'une modification d'article
              if(isset($article_actuelle)) // si cette variable existe alors nous sommes dans le cas d'une modification
              {
                echo '<div class="form-group">';
                echo '<label class="col-sm-4 control-label">Photo Actuelle</label>';
                echo '<img src="' . URL . 'photo/' . $photo_actuelle . '"class="img-thumbnail" width="130" />';
                // on crée un champ caché qui contiendra le nom de la photo afin de la récupérer lors de la validation du formulaire.
                echo '<input type="hidden" name="ancienne_photo" value="' . $photo_actuelle . '" />';
                echo '</div>';
              }
            ?>

            <div class="form-group">
              <label for="photo" class="col-sm-4 control-label">Photo produit</label>
              <div class="col-sm-8">
                <input type="file" name="photo" id="photo">
              </div>
            </div>
            <div class="form-group">
              <label for="prix" class="col-sm-4 control-label">Prix</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="prix" id="prix" placeholder="Prix HT" value="<?php echo $prix ?>">
              </div>
            </div>
            <div class="form-group">
              <label for="stock" class="col-sm-4 control-label">Stock</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="stock" id="stock" placeholder="Stock" value="<?php echo $stock ?>">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-6 col-sm-10">
                <button type="submit" class="btn btn-primary" name="inscription" id="inscription">Soumettre le Produit <span class="glyphicon glyphicon-ok"></span></button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <?php
      }
      ?>

    </div><!-- /.container -->

    <?php
    require("../inc/footer.inc.php");