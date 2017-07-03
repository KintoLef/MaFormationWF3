<?php
require("inc/init.inc.php");


 

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
        <div class="col-sm-2" style="height: 100%; border: 1px solid darkred; border-radius: 3px; background-color: #19BF6F;">
            <h2>Catégories:</h2>
            <br>
            <?php
                // récupérer toutes les catégories en BDD et les afficher dans une liste ul li sous forme de lien a href avec une information GET par exemple: ?categorie=goodies
                $categorie = $pdo->query("SELECT DISTINCT categorie FROM article");

                echo '<ul>';
                echo '<li><a href="boutique.php" style="color: black;">Tous les articles</a></li>';
                while($cat = $categorie->fetch(PDO::FETCH_ASSOC))
                {
                    if($cat["categorie"] == 'vetement')
                    {
                        echo '<li class="dropdown">
                                <a style="color: black;" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                Vêtements</a>';
                        echo '<ul class="dropdown-menu">';

                        $genre = $pdo->query("SELECT DISTINCT sexe FROM article");

                        while($sexe = $genre->fetch(PDO::FETCH_ASSOC))
                        {
                            if($sexe['sexe'] == 'f')
                            {
                                echo '<li><a href="?categorie=' . $cat["categorie"] . '&sexe=' . $sexe['sexe'] . '">Femme</a></li>';
                            }
                            if($sexe['sexe'] == 'm')
                            {
                                echo '<li><a href="?categorie=' . $cat["categorie"] . '&sexe=' . $sexe['sexe'] . '">Homme</a></li>';
                            }
                            
                        }
                        
                        echo '</ul></li>';
                    }
                    elseif($cat["categorie"] == 'goodies')
                    {                    
                    echo '<li><a style="color: black;" href="?categorie=' . $cat["categorie"] . '">Goodies</a></li><br>';
                    }
                }
                echo '</ul>';
            ?>
        </div>
        <div class="col-sm-8 col-sm-offset-1">
            <?php
                // afficher tous les produits dans cette page par exemple: un block avec image+titre+prix
                
                if(isset($_GET['categorie']) && $_GET['categorie'] == 'vetement' && $_GET['sexe'] == 'f')
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
