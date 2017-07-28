<?php
class Ecole
{
	public $nom = 'Ifocop';
	public $cp = 94;
	public function __clone()
	{ // Un clone peut se faire en l'absence de cette méthode. Elle s'exécute en cas de clone demandé et s'applique sur l'objet cloné (et non celui qui sert au clonage).
		$this->cp = 92;
	}
}
//--------------------------------------------------
$ecole1 = new Ecole;
$ecole1->cp = 75;
var_dump($ecole1); // object[1]

$ecole2 = new Ecole;
var_dump($ecole2); // object[2]

$ecole3 = $ecole1; // transmission de la référence [1]
var_dump($ecole3); // object[1]
// lorsque je modifie $ecole1 cela prend effet sur $ecole3 et vice-versa, $ecole1 et $ecole3 sont des références qui pointe vers le même objet #1. ils représentent le même objet.

$ecole3->cp = 91; // modifie $ecole1, $ecole3
echo 'Ecole1> ' . $ecole1->cp . '<hr />';
echo 'Ecole3> ' . $ecole3->cp . '<hr />';

$ecole4 = clone $ecole2; // clone crée un objet et recupère les informations de $ecole2 (le cp passe à 92, voir __clone())
var_dump($ecole4);
//--------------------------------------------------
echo 'ecole1> ' . $ecole1->cp . '<br / >'; // 91
echo 'ecole2> ' . $ecole2->cp . '<br / >'; // 94
echo 'ecole3> ' . $ecole3->cp . '<br / >'; // 91
echo 'ecole4> ' . $ecole4->cp . '<br / >'; // 92
/*****************************
* Communication* 
		En conclusion, j'ai 3 objets et 4 variables qui les représentes.
		Schema
				  RAM
		|----------------------|
		|________Objet1_$cp=91_| <-- représenté par $ecole1, et $ecole3
		|________Objet2________| <-- représenté par $ecole2 (l'origine du clone)
		|________Objet3________| <-- représenté par $ecole4 (la copie après le clone)
		|					   |
		|					   |
		|					   |
		|----------------------|
	les attributs nom et cp sont affecté dans l'objet c'est à dire dans la RAM et non dans la variable qui n'est juste une référence pointant sur l'objet.
*****************************/