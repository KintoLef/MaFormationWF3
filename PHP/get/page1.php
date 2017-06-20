<?php
// sur page1.php et page2.php mettre un titre avec le nom de la page et un lien qui permet de passer d'une page à l'autre.

echo '<h1>Page 1</h1><br/>';
echo "<a href='page2.php?article=jean&couleur=bleu&prix=40'>Aller page 2</a>";
// voir page2.php pour les explications sur $_GET