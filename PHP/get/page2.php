<?php
// sur page1.php et page2.php mettre un titre avec le nom de la page et un lien qui permet de passer d'une page à l'autre.

echo '<h1>Page 2</h1><br/>';
echo "<a href='page1.php'>Aller page 1</a>";

// Pour récupérer une ou des informations depuis l'url, nous pouvons utiliser le protocole HTTP GET.
// en php nous utiliserons la superglobale $_GET
// Une superglobale est disponible dans tous les environnements, notamment dans une fonction sans avoir besoin de l'appeler avec le mot clé 'global'
// TOUTES les superglobales sont des tableaux ARRAY

// dans l'url le '?' précise que l'url est finie, tout ce qui se trouve après sont des informations que nous retrouverons dans $_GET
// syntaxe:
// ?indice1=valeur&indice2=valeur2&indice3=valeur etc...
echo '<pre>'; print_r($_GET); echo '</pre>';

// /!\ $_GET et $_POST sont toujours existantes !!!
// si je fais: if(isset($_GET)) la réponse sera systématiquement TRUE

if(isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix']))
{
    echo 'L\'article est: ' . $_GET['article'] . '<br />';
    echo 'La couleur est: ' . $_GET['couleur'] . '<br />';
    echo 'Le prix est: ' . $_GET['prix'] . '<br />';
}