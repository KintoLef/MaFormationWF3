<?php
require("inc/init.inc.php");

// récupération des films
$liste_films = $pdo->query("SELECT id_movie, title, director, year_of_prod FROM movies");


// récupération des informations du film en BDD pour la vérification de l'existence de celui-ci
if(!empty($_GET))
{
    $id_movie = $_GET['id_movie'];
    $recup_film = $pdo->prepare("SELECT * FROM movies WHERE id_movie = :id_movie");
    $recup_film->bindParam(":id_movie", $id_movie, PDO::PARAM_STR);
    $recup_film->execute();

    // vérification si l'on a bien récupéré un film ou si nous avons une réponse vide
    if($recup_film->rowCount() < 1)
    {
        $content .= '<div class="alert alert-danger" role="alert" style="margin-top: 20px;">Le film que vous recherchez n\'existe pas</div>';
    }
}

require("inc/head.inc.php");
?>

    <div class="container">

        <div class="starter-template">
            <h1 style="text-align: center; margin: 50px 0;"><span class="glyphicon glyphicon-film" style="color: #00BA67;"></span> Affichage des Films</h1>
            <?= $content; // message destiné à l'utilisateur ?>
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
                    $nb_col = $liste_films->columnCount();

                    for($i=0; $i<$nb_col; $i++)
                    {
                        // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
                        $colonne = $liste_films->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
                        echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
                    }

                echo '</tr>';

                while($ligne = $liste_films->fetch(PDO::FETCH_ASSOC))
                {
                    echo '<tr>';

                    foreach($ligne AS $films)
                    {
                        echo '<td style="padding: 10px;">' . $films . '</td>';       
                    }                    

                    echo '<td style="padding: 10px;"><a href="?action=voir_infos&id_movie=' . $ligne['id_movie'] . '">Plus d\'infos</a></td>';  

                    echo '</tr>';
                }

            echo '</table><br>';            
            
        }

        if(isset($_GET['action']) && $_GET['action'] == 'voir_infos' && isset($_GET['id_movie']) && is_numeric($_GET['id_movie']))
        {            
            // récupération des différentes informations du film
            $id_movie = $_GET['id_movie'];
            $info_film = $pdo->prepare("SELECT * From movies WHERE id_movie = :id_movie");
            $info_film->bindParam(":id_movie", $id_movie, PDO::PARAM_STR);
            $info_film->execute();

            // // affichage des informations du film sous forme de tableau
            // echo '<table border="1" style="width:80%; margin: 10px auto; border-collapse: collapse; text-align: center; background: rgba(238, 238, 238, 0.7); border: 1px solid #999;">';

            //     // première ligne du tableau pour le nom des colonnes
            //     echo '<tr>';

            //         // récupération du nombre de colonnes dans la requête:
            //         $nb_col = $info_film->columnCount();

            //         for($i=0; $i<$nb_col; $i++)
            //         {
            //             // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
            //             $colonne = $info_film->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
            //             echo '<th style="padding: 10px; text-align: center;">' . $colonne['name'] . '</th>';
            //         }

            //     echo '</tr>';

            //     while($ligne = $info_film->fetch(PDO::FETCH_ASSOC))
            //     {
            //         echo '<tr>';
            //         foreach($ligne AS $indice => $film)
            //         {
            //             if($indice == 'storyline')
            //             {
            //                 echo '<td style="padding: 10px;">' . substr($film, 0, 60) . '</td>';
            //             }
            //             elseif($indice == 'video')
            //             {
            //                 echo '<td style="padding: 10px;"><a href="' . $film . '">Voir la Bande-Annonce</a></td>';
            //             }                                  
            //             else
            //             {
            //                 echo '<td style="padding: 10px;">' . $film . '</td>';   
            //             }                                     
            //         }
            //     }

            // echo '</table>';

            // affichage des informations du films sous forme de 'panel'
            $film = $info_film->fetch(PDO::FETCH_ASSOC);

                echo '<div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">' . $film['title'] . '</h3>
                        </div>
                        <div class="row" style="padding-left: 30px;">                     
                            <div class="panel-body col-sm-8"><b>Catégory: </b>' .
                                $film['category'] . '<br><br><b>Year of Production: </b>' . $film['year_of_prod'] . '<br><br><b>Director: </b>' . $film['director'] . '<br><br><b>Actors: </b>' . $film['actors'] . '<br><br><b>Producer: </b>' . $film['producer'] . '<br><br><b>Storyline: </b><br>' . $film['storyline'] . '<br><br><a href="' . $film['video'] . '">Voir la Bande-Annonce</a>' .
                            '<hr>
                            </div>   
                        </div>                     
                    </div>';

                echo '<a href="exercice3_affichage.php" class="btn btn-success form-control" style="width: 180px; margin: 10px auto;">Retour aux films</a>';

            
        }
        else
        {
            
        }

        ?>

    </div><!-- /.container -->

<?php
require("inc/footer.inc.php");