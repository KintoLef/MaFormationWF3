<?php
require("../inc/init.inc.php");

// restriction d'accès, si l'utilisateur n'est pas admin alors il ne doit pas accéder à cette page
if(!utilisateur_admin())
{
    header('location:../connexion.php');
    exit(); // permet d'arrêter l'éxécution du script au cas où une personne malveillante ferait des injections via GET
}

// récupération des commandes
$liste_commande = $pdo->query("SELECT id_commande, montant, date, etat FROM commande ORDER BY date DESC");

/**********************************************/
//   MODIFICATION DE L'ETAT DE LA COMMANDE    //
/**********************************************/
// définition des variables d'état
$traitement = 'En cours de traitement';
$envoye = 'Envoyé';
$livre = 'Livré';

if(isset($_GET['modif_etat']) && !empty($_GET['id_commande']))
{
    $id_commande = $_GET['id_commande'];
    $modif_etat = $pdo->prepare('UPDATE commande SET etat = :etat WHERE id_commande = :id_commande');
    $modif_etat->bindParam(':id_commande', $id_commande, PDO::PARAM_STR);

    if($_GET['modif_etat'] == 'traitement')
    {
        $modif_etat->bindParam(':etat', $traitement, PDO::PARAM_STR);
        $modif_etat->execute();
    }
    elseif($_GET['modif_etat'] == 'envoye')
    {
        $modif_etat->bindParam(':etat', $envoye, PDO::PARAM_STR);
        $modif_etat->execute();
    }
    elseif($_GET['modif_etat'] == 'livre')
    {
        $modif_etat->bindParam(':etat', $livre, PDO::PARAM_STR);
        $modif_etat->execute();
    }
    
    header('location:gestion_commande.php');    
}

//******************************************************
//             SUPPRESSION DE LA COMMANDE
//******************************************************
if(isset($_GET['action']) && $_GET['action'] == 'suppr' && !empty($_GET['id_commande']) && is_numeric($_GET['id_commande']))
{
  $id_commande = $_GET['id_commande'];
  $suppression = $pdo->prepare('DELETE FROM commande WHERE id_commande = :id_commande');
  $suppression->bindParam(':id_commande', $id_commande, PDO::PARAM_STR);
  $suppression->execute();  

  // on bascule sur l'affichage du tableau
  header('location:gestion_commande.php');

}

// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
?>

    

    <div class="container">

        <div class="starter-template">
            <h1>Gestion des Commandes</h1>
            <?php // echo $message; // message destinés à l'utilisateur ?>
            <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
        </div>

        <?php
        // affichage de toutes les commandes dans un tableau html
        if(isset($_GET) && empty($_GET['action']))
        {
            // balise ouverture du tableau
            echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';

                // première ligne du tableau pour le nom des colonnes
                echo '<tr>';

                    // récupération du nombre de colonnes dans la requête:
                    $nb_col = $liste_commande->columnCount();

                    for($i=0; $i<$nb_col; $i++)
                    {
                        // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                        $colonne = $liste_commande->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                        echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                    }

                    echo '<th style="padding: 10px; text-align: center;">Modifier Etat</th>';
                    echo '<th style="padding: 10px; text-align: center;">Supprimer</th>';
                echo '</tr>';

                while($ligne = $liste_commande->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<tr>';

                    foreach($ligne AS $commande)
                    {
                        echo '<td style="padding: 10px;">' . $commande . '</td>';       
                    }
                    
                    echo '<td style="padding: 10px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Etat <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?modif_etat=traitement&id_commande=' . $ligne['id_commande'] . '">En cours de traitement</a></li>
                                <li><a href="?modif_etat=envoye&id_commande=' . $ligne['id_commande'] . '">Envoyé</a></li>
                                <li><a href="?modif_etat=livre&id_commande=' . $ligne['id_commande'] . '">Livré</a></li>
                            </ul>
                        </div>                 
                    </td>';

                    echo '<td style="padding: 10px;"><a onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cette commande\'));" href="?action=suppr&id_commande=' . $ligne['id_commande'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></td>';
                    echo '<td style="padding: 10px;"><a href="?action=voir_details&id_commande=' . $ligne['id_commande'] . '">Voir les détails</a></td>';  

                    echo '</tr>';
                }

            echo '</table><br>';
            
            // Calcul du CA
            $calcul_CA = $pdo->query("SELECT SUM(montant) AS 'CA' FROM commande");
            $CA = $calcul_CA->fetch(PDO::FETCH_ASSOC);

            echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';
                echo '<tr>';
                    echo '<td colspan="5">Chiffre d\'Affaire: </td>';
                    echo '<td colspan="2" style="color: darkred;">' . $CA['CA'] . '€</td>';
                echo '</tr>';
            echo '</table>';
        }

        if(isset($_GET['action']) && $_GET['action'] == 'voir_details' && isset($_GET['id_commande']))
        {
            echo '<h2 style="text-align: center;">Détails de la commande n°' . $_GET['id_commande'] . '</h2>';
            
            // récupération des différentes valeurs de la commande
            $info_article = $pdo->prepare("SELECT article.titre, article.photo, details_commande.prix, details_commande.quantite, details_commande.prix*details_commande.quantite AS 'Sous-total' FROM article, details_commande, commande WHERE article.id_article = details_commande.id_article AND details_commande.id_commande = commande.id_commande AND commande.id_commande = :id_commande");
            $info_article->bindParam(":id_commande", $_GET['id_commande'], PDO::PARAM_STR);
            $info_article->execute();

            $info_membre = $pdo->prepare("SELECT membre.id_membre, membre.nom,  membre.prenom,  membre.email,  membre.sexe,  membre.adresse,  membre.cp,  membre.ville  FROM membre, commande WHERE membre.id_membre = commande.id_membre AND commande.id_commande = :id_commande");
            $info_membre->bindParam(":id_commande", $_GET['id_commande'], PDO::PARAM_STR);
            $info_membre->execute();

            // affichage des informations du membre ayant passé la commande
            echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';

                // première ligne du tableau pour le nom des colonnes
                echo '<tr>';

                    // récupération du nombre de colonnes dans la requête:
                    $nb_col = $info_membre->columnCount();

                    for($i=0; $i<$nb_col; $i++)
                    {
                        // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                        $colonne = $info_membre->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                        echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                    }

                echo '</tr>';

                while($ligne = $info_membre->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<tr>';

                    foreach($ligne AS $membre)
                    {
                         echo '<td style="padding: 10px;">' . $membre . '</td>';                               
                    }
                    
                    echo '</tr>';
                }

            echo '</table>';

            // affichage du détail du la commande
            echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';

                // première ligne du tableau pour le nom des colonnes
                echo '<tr>';

                    // récupération du nombre de colonnes dans la requête:
                    $nb_col = $info_article->columnCount();

                    for($i=0; $i<$nb_col; $i++)
                    {
                        // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                        $colonne = $info_article->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                        echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                    }

                echo '</tr>';

                while($ligne = $info_article->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<tr>';

                    foreach($ligne AS $indice => $article)
                    {
                        if($indice == 'photo')
                        {
                            echo '<td style="padding: 10px;"><img src="' . URL . 'photo/' . $article . '" width="120"></td>';
                        }
                        else
                        {
                            echo '<td style="padding: 10px;">' . $article . '</td>';   
                        }                                     
                    }
                    
                    echo '</tr>';
                }

            echo '</table>';
        }

        ?>
    </div><!-- /.container -->

    <?php
    require("../inc/footer.inc.php");
