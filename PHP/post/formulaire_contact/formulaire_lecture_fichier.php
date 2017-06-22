<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Quentin Lefevre">

    <title>Formulaire Contact</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Style CSS -->
    <link href="css/style.css" rel="stylesheet">

  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Project name</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">

      <div class="starter-template">
        <h1>Lecture de fichier</h1>
      </div>
      <?php
        // après avoir vu comment enregister des données dans un fichier sur le serveur, nous allons les récupérer afin de les manipuler sur ce fichier.

        $nom_fichier = 'liste.txt';
        $contenu_fichier = file($nom_fichier);
        // file() fait tout le travail pour nous
        // cette fonction retourne chaque ligne d'un fichier dans un tableau array
        echo '<pre>'; print_r($contenu_fichier); echo '</pre>';

        // afficher dans une liste ul li chaque ligne récupérée du fichier liste.txt
        $longueur_contenu_fichier = sizeof($contenu_fichier);
        echo '<ul>';

        for($i=0; $i<$longueur_contenu_fichier; $i++)
        {
            echo '<li>' . $contenu_fichier[$i] . '</li>'; 
        }
        echo '</ul>';

        // Avec boucle FOREACH
        echo '<ul>';
        foreach($contenu_fichier AS $val)
        {
            $position_tiret = strpos($val, '-');
            $position_tiret += 2;
                        
            echo '<li>' . $val . '</li>';
            echo '<li style="color: red;">' . substr($val, 0, ($position_tiret-2)) . '</li>'; // affichage du pseudo uniquement
            echo '<li style="color: blue;">' . substr($val, $position_tiret) . '</li>'; // affichage du mail uniquement
        }
        echo '</ul>';
      ?>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
