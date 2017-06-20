<?php
// récupérer 5 images sur le web et les renommer de cette façon:
// image1.jpg
// image2.jpg
// image3.jpg
// image4.jpg
// image5.jpg

// 1. afficher une image avec une balise <img>
echo "<img src='image1.jpg' alt='image' />";
echo '<hr />';

// 2. afficher une image 5 fois toujours en écrivant 1 seule balise <img>
for($i=1; $i<=5; $i++)
{
    echo "<img src='image1.jpg' alt='image' />";
}
echo '<hr />';

// 3. afficher les 5 images différentes toujours en écrivant une seule balise <img>
for($i=1; $i<=5; $i++)
{
    echo "<img src='image" . $i . ".jpg' alt='image' />";
}