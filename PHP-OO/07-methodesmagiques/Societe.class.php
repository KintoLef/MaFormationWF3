<?php
class Societe
{
	public $adresse;
	public $ville;
	public $cp;
	public function __construct(){}
	public function __set($nom, $valeur) // se délenche uniquement en cas de tentative d'affectation sur une propriété qui n'existe pas
	{
		echo "La propriété $nom n'existe PAS, la valeur $valeur n'a donc pas été affectée!<hr />";
	}
	public function __get($nom)  // se délenche uniquement en cas de tentative d'affichage sur une propriété qui n'existe pas
	{
		echo "La propriété $nom n'existe PAS, on ne peut donc pas l'afficher!<hr />";
	}
	public function __call($nom, $argument) // se délenche uniquement en cas de tentative d'exécution sur une propriété qui n'existe pas
	{
		echo "Tentative d'exécuter la méthode $nom mais elle n'existe PAS. <br /> Les arguments étaient " . implode("-",$argument) . '<hr />';
	}
	/*
	Pour information, d'autres méthodes magiques existe :
	__callStatic($nom, $argument) : pour les méthodes 'static'.
	__isset($nom) : se lance lors d'une condition isset/empty sur une propriété
	__destruct() : se lance à la fin de l'exécution du script. Pratique pour fermer la connexion à la BDD ou fermer un fichier en écriture.
	__toString() : se lance lorsque un objet tente d'être affiché par un 'echo'
	il y a aussi : __wakeup(), __sleep(), __invoke(), __clone() ...
	*/
}
//------------------------------------
$societe1 = new Societe;
// $societe1->villes = 'Paris'; // 1er test : lorsque nous tentons d'affecter une valeur à une propriété inexistante, cela fonctionne et ajoute la propriété ainsi que la valeur à l'objet. (anormal).
// echo $societe1->titre; // 2e test : erreur undefine, normal, la propriété n'existe pas, elle ne peut donc pas être affichée.
// $societe1->methode(); // 3e test : fatal erreur, normal, la méthode n'existe pas

$societe1->pays = 'France'; // déclenchement de la méthode __set() au lieu de la création d'une nouvelle propriété.
$societe1->ville = 'Paris'; // La propriété existe, aucun déclenchement. tout va bien.
echo $societe1->titre;  // déclenchement de __get() au lieu d'une erreur unedifine.
echo $societe1->fsdfdssdf(1,2,3); // déclenchement de __call() au lieu d'une fatal error.

print '<pre>'; print_r($societe1); print '</pre>'; // A noter pour voir ce qu'il y a dans notre objet.
/*
Commentaire :
	Tentative d'affecter une propriété qui n'existe pas
		PHP d'origine : ça marche (pas normal), la propriété est créée, la valeur est affectée (et c'est l'un des seuls langages qui laisse passer ça, PHP est trop permissif, variable non typés, etc).
		Avec __set : pas d'affectation si la propriété n'existe pas, et possibilité d'adresser un message d'erreur traité en Français (c'est une sorte de pansement pour une incohérence)

	Tentative d'affichage d'une propriété qui n'existe pas
		PHP d'origine : unedifine (normal)
		Avec __get : pas d'erreur sale, et possibilité d'adresser un message d'erreur traité en Français

	Tentative d'exécuter une méthode qui n'existe pas
		PHP d'origine : Fatal error (normal)
		Avec __call : pas d'erreur sale, et possibilité d'adresser un message d'erreur traité en Français

	En PHP, il n'y a pas assez d'erreur orange.
	On dit qu'un site ou une application est vraiment fini quand tous les cas sont prévu.
	Sur un site, vous vous authentifier, ca ne fonctionne pas, il y'a écrit "erreur d'authentification", c'est une erreur propre, pas de message d'erreur orange, warning et compagnie.