<h1>EX 2 - Lien GET</h1>

<ul>
    <li><a href="lien.php?pays=Fr">France</a></li>
    <li><a href="lien.php?pays=Es">Espagne</a></li>
    <li><a href="lien.php?pays=Ita">Italie</a></li>
    <li><a href="lien.php?pays=Ger">Allemagne</a></li>
    <li><a href="lien.php?pays=Ang">Angleterre</a></li>
</ul>
<hr />

<?php
    if(isset($_GET['pays']))
    {
        $pays = $_GET['pays'];

        if($pays == 'Fr')
        {
            echo 'Vous êtes Français ?';
        }
        if($pays == 'Es')
        {
            echo 'Vous êtes Espagnol ?';
        }
        if($pays == 'Ita')
        {
            echo 'Vous êtes Italien ?';
        }
        if($pays == 'Ger')
        {
            echo 'Vous êtes Allemand ?';
        }
        if($pays == 'Ang')
        {
            echo 'Vous êtes Anglais ?';
        }
        if($pays != 'Fr' XOR $pays != 'Es' XOR $pays != 'Ita' XOR $pays != 'Ger' XOR $pays != 'Ang')
        {
            echo 'Houlà !! On a un petit malin qui manipule l\'URL !!';
        }
    } else {
        echo 'Veuillez sélectionner un pays !!';
    }
?>