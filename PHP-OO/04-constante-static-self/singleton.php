<?php
// 04-constante-static-self/singleton.php

// Design Pattern (patron de conception): C'est uné réponse trouvée par d'autres dev. à un problème rencontré par la communauté.

// Singleton: C'est la réponse à la question suivante -> Comment faire pour créer une classe qui ne peut être instanciable qu'UNE SEULE ET UNIQUE FOIS ?

class Singleton
{
    private static $instance = NULL; // D'abord NULL puis va contenir l'UNIQUE OBJET de la classe Singleton
    private function __construct(){} // Fonction private, donc la classe ne peut pas être instanciée
    private function __clone(){} // Fonction private, donc l'objet de la classe ne pourra pas être cloné

    public static function getInstance(){
        if(is_null(self::$instance)){
            self::$instance = new Singleton;
            // self:$instance = new self;
        }
        return self::$instance;
    }
}
//-----------------------------------------
// $singleton = new Singleton; // IMPOSSIBLE !!!

$objet = Singleton::getInstance();
$objet2 = Singleton::getInstance();
echo '<pre>'; 
var_dump($objet);
var_dump($objet2);
echo '</pre>';