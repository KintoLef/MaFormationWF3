<?php
// 05-heritage/animal.php

class Animal
{
    protected function deplacement(){
        return 'Je me déplace !';
    }

    public function manger(){
        return 'Je mange !';
    }
}
//-------------------------------------------

class Elephant extends Animal
{
    public function quiSuisJe(){
        return 'Je suis un éléphant et ' . $this -> deplacement() . ' !';
        // Je peux appeler la méthode deplacement avec $this -> car on hérite également des méthodes protected.
    }
}

class Chat extends Animal
{
    public function quiSuisJe(){
        return 'Je suis un chat !';
    }

    public function manger(){
        return 'Je mange peu... car je suis un chat !';
        // La fonction manger existe déjà dans la classe mère (Animal)... Mais puisque mon entité Chat a des caractéristiques particulières (manger peu) on peut REDÉFINIR une méthode héritée.
    }
}
//--------------------------------------------

$dumbo = new Elephant;
echo 'Elephant: ' . $dumbo -> quiSuisJe() . '<br>';
echo 'Elephant: ' . $dumbo -> manger() . '<br>';

$felix = new Chat;
echo 'Chat: ' . $felix -> quiSuisJe() . '<br>';
echo 'Chat: ' . $felix -> manger() . '<br>';

/*
Commentaires:
    L'héritage est un des fondements de la programmation orientée objet.
    Lorsqu'une classe hérite d'une autre classe, elle importe tout le code. Les éléments sont donc appelés avec $this-> (à l'intérieur de la classe).

    Redéfinition: Une classe enfant (héritière) peut modifier ENTIEREMENT le comportement d'une méthode dont elle a héritée. Lors de l'exécution, l'interpréteur va dans un premier temps regarder dans la classe enfant si la méthode existe... puis dans la classe mère.

    REDEFINITION != SURCHARGE (voir chapitre 6)
*/