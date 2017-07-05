<?php
require("../inc/init.inc.php");

// restriction d'accès, si l'utilisateur n'est pas admin alors il ne doit pas accéder à cette page
if(!utilisateur_admin())
{
    header('location:../connexion.php');
    exit(); // permet d'arrêter l'éxécution du script au cas où une personne malveillante ferait des injections via GET
}

// récupération des membres
$liste_membre = $pdo->query("SELECT * FROM membre");

/**********************************************/
//    MODIFICATION DU STATUT DU MEMBRE        //
/**********************************************/
// définition des variables d'état
$admin = 1;
$membre = 0;

if(isset($_GET['modif_statut']) && !empty($_GET['id_membre']))
{
    $id_membre = $_GET['id_membre'];
    $modif_statut = $pdo->prepare('UPDATE membre SET statut = :statut WHERE id_membre = :id_membre');
    $modif_statut->bindParam(':id_membre', $id_membre, PDO::PARAM_STR);

    if($_GET['modif_statut'] == 'admin')
    {
        $modif_statut->bindParam(':statut', $admin, PDO::PARAM_STR);
        $modif_statut->execute();
    }
    elseif($_GET['modif_statut'] == 'membre')
    {
        $modif_statut->bindParam(':statut', $membre, PDO::PARAM_STR);
        $modif_statut->execute();
    }
        
    header('location:gestion_utilisateur.php');    
}

//******************************************************
//             SUPPRESSION DE LA COMMANDE
//******************************************************
if(isset($_GET['action']) && $_GET['action'] == 'suppr' && !empty($_GET['id_membre']) && is_numeric($_GET['id_membre']))
{
  $id_membre = $_GET['id_membre'];
  $suppression = $pdo->prepare('DELETE FROM membre WHERE id_membre = :id_membre');
  $suppression->bindParam(':id_membre', $id_membre, PDO::PARAM_STR);
  $suppression->execute();  

  // on bascule sur l'affichage du tableau
  header('location:gestion_utilisateur.php');

}

// la ligne suivante commence les affichages dans la page
require("../inc/header.inc.php");
require("../inc/nav.inc.php");
?>

    

    <div class="container">

      <div class="starter-template">
        <h1>Gestion des Utilisateurs</h1>
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
                    $nb_col = $liste_membre->columnCount();

                    for($i=0; $i<$nb_col; $i++)
                    {
                        // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                        $colonne = $liste_membre->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                        echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                    }

                    echo '<th style="padding: 10px; text-align: center;">Modifier Etat</th>';
                    echo '<th style="padding: 10px; text-align: center;">Supprimer</th>';
                echo '</tr>';

                while($ligne = $liste_membre->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<tr>';

                    foreach($ligne AS $membre)
                    {
                        echo '<td style="padding: 10px;">' . $membre . '</td>';       
                    }
                    
                    echo '<td style="padding: 10px;">
                        <div class="btn-group">
                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Statut <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="?modif_statut=admin&id_membre=' . $ligne['id_membre'] . '">Admin</a></li>
                                <li><a href="?modif_statut=membre&id_membre=' . $ligne['id_membre'] . '">Membre</a></li>
                            </ul>
                        </div>                 
                    </td>';

                    echo '<td style="padding: 10px;"><a onclick="return(confirm(\'Etes-vous sûr de vouloir supprimer cet utilisateur\'));" href="?action=suppr&id_membre=' . $ligne['id_membre'] . '" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span> Supprimer</a></td>';  

                    echo '</tr>';
                }

            echo '</table><br>';
        }
      ?>
      
    </div><!-- /.container -->

    <?php
    require("../inc/footer.inc.php");