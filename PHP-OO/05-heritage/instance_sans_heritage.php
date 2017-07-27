<?php
// 05-heritage/instance_sans_heritage.php

class A
{
    public function direBonjour(){
        return 'Bonjour !';
    }
}
//-------------------------------------
class C{}
//-------------------------------------
class B extends C // B hérite de C... donc ne peut pas hériter de A
{
    public $maVariable; // contient un objet de la classe A

    public function __construct(){
        $this -> maVariable = new A;
    }
}
//-------------------------------------
$b = new B;
echo $b -> maVariable -> direBonjour(); // $b -> maVariable devient un objet de la classe A

/*
Commentaires:
    Nous avons un objet dans un objet.

    L'intérêt d'avoir une instance sans héritage (récupérer un objet dans la propriété d'une classe) est de pouvoir hériter d'une classe mère d'un côté tout en ayant la possibilité de récupérer les éléments d'une autre classe en même temps.
*/