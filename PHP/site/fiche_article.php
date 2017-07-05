<?php
require("inc/init.inc.php");

// on vérifie si l'indice id_article existe dans $_GET ou s'il n'est pas vide
if(empty($_GET['id_article']) || !is_numeric($_GET['id_article']))
{
    header('location:boutique.php');
}

// récupération des informations de l'article en BDD
$id_article = $_GET['id_article'];
$recup_article = $pdo->prepare("SELECT * FROM article WHERE id_article = :id_article");
$recup_article->bindParam(":id_article", $id_article, PDO::PARAM_STR);
$recup_article->execute();

// vérification si l'on a bien récupéré un article ou si nous avons une réponse vide (exemple changement d'id_article dans l'URL par l'utilisateur)
if($recup_article->rowCount() < 1)
{
    // s'il y a moins d'une ligne alors la réponse de la BDD est vide donc on redirige vers l'accueil
    header('location:boutique.php');
}

$article = $recup_article->fetch(PDO::FETCH_ASSOC);

// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>

    

    <div class="container">
        <div class="starter-template">
            <h1>Fiche Article</h1>
            <?php // echo $message; // message destinés à l'utilisateur ?>
            <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
        </div>

        <?php
            echo '<div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">' . $article['titre'] . '</h3>
                    </div>
                    <div class="row">                     
                        <div class="panel-body col-sm-4" style="text-align: center">
                            <img src="' . URL . 'photo/' . $article['photo'] . '" width="120">
                        </div>
                        <div class="panel-body col-sm-8">Catégorie: ' .
                            $article['categorie'] . '<br><br>Prix: ' . $article['prix'] . '€<br><br>Taille: ' . $article['taille'] . '<br><br>Sexe: ' . $article['sexe'] . '<br><br>Description: <br>' . $article['description'] .
                        '<hr>
                        </div>   
                    </div>                     
                </div>';
            
            // on affiche le formulaire d'ajout si le stock est supérieur à zéro
            if($article['stock'] > 0)
            {
                // formulaire d'ajout au panier
                echo '<div class="col-sm-2 col-sm-offset-5"><form method="post" action="panier.php">';

                // on récupère l'id_article dans un champs caché afin de savoir ensuite quel est le produit qui a été ajouté
                echo '<input type="hidden" name="id_article" value="' . $article['id_article'] . '" />';

                // faire un champ select pour la quantité selon la quantité disponible du produit avec une sécurité pour afficher maximum 5 si la quantité est supérieur (2ème condition d'entrée dans la boucle)
                echo '<label for="quantite" class="col-sm-4 control-label">Quantité</label>';
                echo '<select name="quantite" class="form-control">';
                for($i=1; $i<=$article['stock'] && $i<6 ; $i++)
                {
                        echo '<option>' . $i . '</option>';                
                }
                echo '</select><br>';

                echo '<input type="submit" name="ajout_panier" value="Ajouter au Panier" class="form-control btn btn-primary" />';
                echo '</form></div><br>';
            }
            else
            {
                echo '<h3 class="text-danger">Rupture de stock pour ce produit !!</h3>';
            }
			echo '<div class="col-sm-4 col-sm-offset-4">
                    <a href="boutique.php?categorie=' . $article['categorie'] . '" class="btn btn-success form-control">Retour vers votre sélection</a>
                  </div>';          
                        

        ?>

    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");
