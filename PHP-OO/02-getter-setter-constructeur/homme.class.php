<?php
// 02-getter-setter-constructeur/homme.class.php

class Homme
{
    private $prenom; // propriété private
    private $nom; // propriété private

    public function getPrenom(){
        return $this -> prenom;
    }

    public function setPrenom($arg){
        if(!empty($arg) && strlen($arg) > 3 && strlen($arg) < 20 && is_string($arg)){
            $this -> prenom = $arg;
        }
        else {
            return false;
        }        
    }
}
//--------------------------------------------------

$homme = new Homme;
// $homme -> prenom = 'Quentin'; // Erreur: La propriété $prenom est private, je n'y ai pas accès en dehors de la classe
$_POST['prenom'] = 'Quentin';
$homme -> setPrenom($_POST['prenom']);
echo 'Prénom: ' . $homme -> getPrenom();

/*
Commentaires:
    Pourquoi faire des getter et des setter ?
        - Le PHP est un langage qui ne type pas ses variables. Il faut donc constamment vérifier l'intégrité de celles-ci. Donc mettre une propriété en private, et créer les getter et setter, permet de vérifier une seule fois l'intégrité des données.
        - Tout dev' qui voudra affecter une valeur DEVRA OBLIGATOIREMENT passer par le setter !
        ==> CECI EST UNE BONNE CONTRAINTE !!

    $this représente l'objet en cours de manipulation.

    Setter: Affecter une valeur
    Getter: Récupérer la valeur

    Nous aurons autant de getter/setter que de propriété private
*/