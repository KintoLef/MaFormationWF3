<?php
//10-autoload/autoload.php

function inclusion_automatique($className){
    // La classe A est dans le fichier A.class.php
    require $className . '.class.php';

    //-----------------------------------------
    echo 'On passe dans l\'autoload <br>';
    echo 'On fait un : require "' . $className . '.class.php"<br>';
}

//----------------------------
spl_autoload_register('inclusion_automatique');
//----------------------------

/*
Commentaires:
    spl_autoload_register():
        - Est une fonction super pratique, qui va s'exécuter lorsqu'elle va voir passer le mot clé 'new'.
        - Elle va lancer une fonction... celle que nous allons lui préciser en argument
        - Elle va apporter à ma fonction le mot qui suit le(s) mot(s) clé 'new', càd, le nom de la classe.
*/