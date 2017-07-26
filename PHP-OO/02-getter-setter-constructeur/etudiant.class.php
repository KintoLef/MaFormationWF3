<?php
// 02-getter-setter-constructeur/exercice_membre.php

class Etudiant
{
    private $prenom;

    public function __construct($arg){
        $this -> setPrenom($arg);
    }

    public function getPrenom(){
        return $this -> prenom;
    }
    public function setPrenom($prenom){
        $this -> prenom = $prenom;
    }
}
//---------------------------------------------

$etudiant = new Etudiant('Quentin');
echo $etudiant -> getPrenom();

/*
Commentaires:
    - LA méthode magique __construct() s'exécute automatiquement au moment de l'instanciation.
    - Il n'est pas obligatoire de la déclarer, en théorie on ne la déclare que si on a besoin d'automatiser un traitement.
    - On l'utilise souvent pour déployer automatiquement notre application (instance sans héritage par exemple, vois chap.5).
    - Toutes les méthodes magiques s'écrivent avec le double underscore(__).
*/