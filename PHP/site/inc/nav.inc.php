<nav class="navbar navbar-fixed-top" style="background-color: #3436CC;">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo URL; ?>boutique.php" style="font-family: 'Luckiest Guy', cursive; color: white;">PopShop Marvel</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            
            <li class="active"><a href="<?php echo URL; ?>boutique.php">Accueil</a></li>
            <li><a href="panier.php">Panier</a></li>

            <?php
              if(!utilisateur_connecte())
              {
            ?>
            <li><a href="<?php echo URL; ?>inscription.php">Inscription</a></li>
            <li><a href="<?php echo URL; ?>connexion.php">Connexion</a></li>
            <?php
              }
              else {
            ?>
            <li><a href="<?php echo URL; ?>profil.php">Profil</a></li>
            <li><a href="<?php echo URL; ?>connexion.php?action=deconnexion">Déconnexion</a></li>
            <?php
              }

              // rajout des liens d'administration si l'utilisateur est admin
              if(utilisateur_admin())
              {
                echo '<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        Administration <span class="caret"></span></a>';
                echo '<ul class="dropdown-menu">';
                echo '<li><a href="' . URL . 'admin/gestion_boutique.php">Gestion boutique</a></li>';
                echo '<li><a href="' . URL . 'admin/gestion_commande.php">Gestion commande</a></li>';
                echo '<li><a href="' . URL . 'admin/gestion_utilisateur.php">Gestion utilisateur</a></li>';
                echo '</ul></li>';
              }
            ?>

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>