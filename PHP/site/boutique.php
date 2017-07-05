<?php
require("inc/init.inc.php");


 // récupération des couleurs
 $liste_couleur = $pdo->query("SELECT DISTINCT couleur FROM article");

 // récupération des prix
 $liste_prix = $pdo->query("SELECT prix FROM article");

 // récupération des taille
 $liste_taille = $pdo->query("SELECT DISTINCT taille FROM article");

function affichage_produit($arg)
{
    global $pdo;
    $produits = $pdo -> query("SELECT * FROM article $arg");

    while($article = $produits->fetch(PDO::FETCH_ASSOC))
    {
        echo '<div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">' . $article['titre'] . '</h3>
                </div>
                <div class="row">
                    <div class="panel-body col-sm-8" style="padding-left: 50px;">' .
                        $article['description'] . '<br><br><br>Prix: ' . $article['prix'] .
                    '€<hr><a href="fiche_article.php?id_article=' . $article['id_article'] . '" class="btn btn-primary">Voir la fiche article</a></div>                         
                    <div class="panel-body col-sm-4">
                        <img src="' . URL . 'photo/' . $article['photo'] . '" width="120">
                    </div> 
                </div>                     
                </div>';
    }
}

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>

    

    <div class="container">

      <div class="starter-template">
        <h1>Boutique</h1>
        <?php // echo $message; // message destinés à l'utilisateur ?>
        <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
      </div>

      <div class="row">
        <div class="col-sm-3">
            <form class="form-horizontal" method="post" action="">
                <div class="form-group">
                    <label for="recherche" class="col-sm-8 control-label">Recherche par mot-clé</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" value="">
                    </div>
                    <div class="col-sm-2">
                        <button type="submit" class="btn btn-primary" name="recherche" id="recherche" style="background-color: #00BA67; border: 1px solid #B21428"><span class='glyphicon glyphicon-ok'></span></button>
                    </div>
                </div>
            </form>
            <br>
            <div style="padding-left: 30px; height: 100%; border: 1px solid blue; border-radius: 3px; background-color: #19BF6F;">
                <h2>Catégories:</h2>
                <br>
                <?php
                    // récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de lien a href avec une information GET par exemple: ?categorie=goodies
                    $categorie = $pdo->query("SELECT DISTINCT categorie FROM article");

                    echo '<ul>';
                    echo '<li><h4><a href="boutique.php" style="color: black;">Tous les articles</a></h4></li><br>';
                    while($cat = $categorie->fetch(PDO::FETCH_ASSOC))
                    {
                        if($cat["categorie"] == 'vetement')
                        {
                            echo '<li>
                                    <h4><a style="color: black;" href="?categorie=' . $cat["categorie"] . '">Vêtements</a></h4>';
                            echo '<ul>';

                            $genre = $pdo->query("SELECT DISTINCT sexe FROM article");

                            while($sexe = $genre->fetch(PDO::FETCH_ASSOC))
                            {
                                if($sexe['sexe'] == 'f')
                                {
                                    echo '<li><a style="color: black;" href="?categorie=' . $cat["categorie"] . '&sexe=' . $sexe['sexe'] . '">Femme</a></li>';
                                }
                                if($sexe['sexe'] == 'm')
                                {
                                    echo '<li><a style="color: black;" href="?categorie=' . $cat["categorie"] . '&sexe=' . $sexe['sexe'] . '">Homme</a></li><br>';
                                }
                                
                            }
                            
                            echo '</ul></li>';
                        }
                        elseif($cat["categorie"] == 'goodies')
                        {                    
                        echo '<li><h4><a style="color: black;" href="?categorie=' . $cat["categorie"] . '">Goodies</a></h4></li><br>';
                        }
                    }
                    echo '</ul>';
                ?>
            </div>
            <br>
            <div>
                <h3>Filtres</h3>
                <form class="form-horizontal" method="post" action="">
                    <div class="form-group">
                        <label for="prix" class="col-sm-9 control-label" style="text-align: left;">Prix</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" name="prix_min" id="prix_min" value="" placeholder="Min">
                        </div>
                        <div class="col-sm-5">
                            <input type="text" class="form-control" name="prix_max" id="prix_max" value="" placeholder="Max">
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary" name="recherche" id="recherche" style="background-color: #00BA67; border: 1px solid #B21428"><span class='glyphicon glyphicon-ok'></span></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="couleur" class="col-sm-8 control-label" style="text-align: left;">Couleur</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="couleur" id="couleur">
                                <option></option>
                            <?php
                                while($couleur = $liste_couleur->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo '<option>' . $couleur['couleur'] . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary" name="recherche" id="recherche" style="background-color: #00BA67; border: 1px solid #B21428"><span class='glyphicon glyphicon-ok'></span></button>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="taille" class="col-sm-8 control-label" style="text-align: left;">Taille</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="taille" id="taille">
                                <option></option>
                            <?php
                                while($taille = $liste_taille->fetch(PDO::FETCH_ASSOC))
                                {
                                    echo '<option>' . $taille['taille'] . '</option>';
                                }
                            ?>
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary" name="recherche" id="recherche" style="background-color: #00BA67; border: 1px solid #B21428"><span class='glyphicon glyphicon-ok'></span></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8 col-sm-offset-1">
            <?php
                // afficher tous les produits dans cette page par exemple: un block avec image+titre+prix
                
                if($_POST)
                {
                    if(!empty($_POST['couleur']) && empty($_POST['taille']))
                    {
                        $filtre_couleur = $_POST['couleur'];
                        affichage_produit("WHERE couleur = '$filtre_couleur'");
                    }
                    
                    if(!empty($_POST['taille']))
                    {
                        $filtre_taille = $_POST['taille'];
                        
                        if($_POST['couleur'])
                        {
                            $filtre_couleur = $_POST['couleur'];
                            affichage_produit("WHERE couleur = '$filtre_couleur' AND taille = '$filtre_taille'");
                        }
                        else
                        {
                            affichage_produit("WHERE taille = '$filtre_taille'");
                        }
                    }
                    
                    if(empty($_POST['couleur']) && empty($_POST['taille']))
                    {
                        affichage_produit("");
                    }
                }
                elseif(isset($_GET['categorie']) && $_GET['categorie'] == 'vetement' && empty($_GET['sexe']))
                {
                    affichage_produit("WHERE categorie = 'vetement'");
                }                
                elseif(isset($_GET['categorie']) && $_GET['categorie'] == 'vetement' && $_GET['sexe'] == 'f')
                {
                    affichage_produit("WHERE sexe = 'f'");
                }
                elseif(isset($_GET['categorie']) && $_GET['categorie'] == 'vetement' && $_GET['sexe'] == 'm')
                {
                    affichage_produit("WHERE sexe = 'm'");
                }
                elseif(isset($_GET['categorie']) && $_GET['categorie'] == 'goodies')
                {
                    affichage_produit("WHERE categorie = 'goodies'");
                }
                else
                {                    
                    affichage_produit("");
                }

                
                
            ?>
        </div>
      </div>

    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");
