<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Moi">

    <title>Ma Boutique</title>
	<!-- favicon -->
	<link href="<?php echo URL; ?>img/fav.png" rel="icon">

    <!-- Bootstrap core CSS -->
    <link href="<?php echo URL; ?>css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo URL; ?>css/style.css" rel="stylesheet">
  </head>
  <body>
	<!---- FIN HEADER ---->
  
  
	<!---- DEBUT NAV ---->
	<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo URL; ?>boutique.php">Ma Boutique</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">		  
		  
            <li class="active"><a href="<?php echo URL; ?>boutique.php">Accueil</a></li>
            <li><a href="">Panier</a></li>

            <li><a href="">Inscription</a></li>
            <li><a href="">Connexion</a></li>			
			<li><a href="">Profil</a></li>
            <li><a href="">Déconnexion</a></li>
			<li class="dropdown">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Administration <span class="caret"></span></a>
				<ul class="dropdown-menu">
				
					<li><a href="">Gestion boutique</a></li>
					<li><a href="">Gestion commande</a></li>
					<li><a href="">Gestion utilisateur</a></li>
				
				</ul></li>	
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
	<!---- FIN NAV ---->




  

  <div class="container">
      <div class="starter-template">
        <h1><span class="glyphicon glyphicon-list" style="color: NavajoWhite;"></span> Fiche Article</h1>
        <?php // echo $message; // messages destinés à l'utilisateur ?>
		<?= $message; // cette balise php inclue un echo // cette ligne php est equivalente à la ligne au dessus. ?>
      </div>
	  <div class="row">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="panel panel-info">
			  <div class="panel-heading" style="padding: 20px 210px;"><img src="img/logo-boutique.gif" class="img-responsive" /></div>
			  <div class="panel-body">
			  <div class="col-md-6" style="text-align: center;">
				<img src="photo/<?= $article['photo'] ?> '"  class="img-responsive" />
			  </div>
			  <div class="col-md-6" style="text-align: left;">
				
					<h2><?=$article['titre'] ?></h2><hr />
					<p><b class="label_fiche">Référence: </b><?=$article['reference'] ?></p>
					<p><b class="label_fiche">Catégorie: </b><?=$article['categorie'] ?></p><hr />
					<p><b class="label_fiche">Prix: </b><?=$article['prix'] ?>€ </p>
					<p><b class="label_fiche">Couleur: </b><?=$article['couleur'] ?></p>
					<p><b class="label_fiche">Taille: </b><?=$article['taille'] ?></p>
					<p><b class="label_fiche">Sexe: </b><?=$sexe ?></p>
					<hr />
			
			  </div>
			  <div class="col-md-12">
					<hr /><p><?=$article['description'] ?></p>
					<hr />
					
					<?php if( $article['stock'] > 0 ) :?>
					
						<form method="post" action="panier.php">
						<input type="hidden" name="id_article" value="<?=$article['id_article'] ?>" />
						<select name="quantite" class="form-control">
						
						<?php for($i = 1; $i <= $article['stock'] && $i < 8; $i++): ?>
							<option><?=$i ?></option> 
						<?php  endfor; ?>
						
						</select><br />
						
						<input type="submit" name="ajout_panier" value="Ajouter au panier"  class="form-control btn btn-warning" />
						
						</form>
					<?php else : ?>
						<h3>Rupture de stock pour ce produit</h3>
					<?php endif ?>
					<hr />
					<a href="" class="btn btn-success form-control">Retour vers votre sélection</a>
			  </div>
				
			  </div>
			</div>
		</div>
	  </div>
	  

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
  </body>
</html>















