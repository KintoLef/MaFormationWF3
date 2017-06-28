<?php
require("inc/init.inc.php");



// la ligne suivante commence les affichages dans la page
require("inc/header.inc.php");
require("inc/nav.inc.php");
?>

    

    <div class="container">

      <div class="starter-template">
        <h1>Bootstrap starter template</h1>
        <?php // echo $message; // message destinés à l'utilisateur ?>
        <?= $message; // cette balise php inclus un echo (equivalent à la ligne du dessus) ?>
      </div>

    </div><!-- /.container -->

    <?php
    require("inc/footer.inc.php");











