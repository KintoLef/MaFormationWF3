<?php
// 02-getter-setter-constructeur/exercice_membre.php

/* Consignes:
    Au regard de la classe ci-dessous, créez un membre, affectez-lui un pseudo et un email et affichez les informations.
*/

class Membre
{
    private $pseudo;
    private $email;

    public function getPseudo(){
        return $this -> pseudo;
    }

    public function setPseudo($arg){
        if(!empty($arg) && strlen($arg) > 3 && strlen($arg) < 20 && is_string($arg)){
            $this -> pseudo = $arg;
        }
        else {
            return false;
        }        
    }

    public function getEmail(){
        return $this -> email;
    }

    public function setEmail($arg){
        $this -> email = $arg;
    }
}

$membre = new Membre;
// $_POST['pseudo'] = 'KintoLef';
// $_POST['email'] = 'quinto_lefevre@hotmail.com';
$membre -> setPseudo('KintoLef');
$membre -> setEmail('quinto_lefevre@hotmail.com');
echo 'Pseudo: ' . $membre -> getPseudo() . '<br>Email: ' . $membre -> getEmail() . '<br>';