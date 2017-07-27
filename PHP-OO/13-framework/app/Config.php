<?php
//app/Config.php

class Config
{
	protected $parameters;
	
	public function __construct(){
		require __DIR__ . '/Config/parameters.php';
		$this -> parameters = $parameters;
		// Au moment où j'instancierai ma classe Config, je récupère les parametres du site pour les stocker dans la propriété $parameters. 
	}
	
	public function getParametersConnect(){
		return $this -> parameters['connect'];
		// Cette fonction me retourne seulement la partie connexion des paramètres. Elle sera utile à PDOManager. 
	}

}
// $config = new Config; 
// echo '<pre>'; 
// print_r($config -> getParametersConnect());
// echo '</pre>'; 







