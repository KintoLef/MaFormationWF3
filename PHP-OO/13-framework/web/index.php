<?php
//web/index.php

session_start(); 
require_once __DIR__ . '/../vendor/autoload.php';

//Lancement de l'application (interupteur) : 
// $app = new Application;
// $app -> run(); 

//TEST 1 : Entity
// $article = new Entity\Article; 
// $article -> setTitre('Mon super article !'); 
// echo $article -> getTitre(); 


// TEST 2 : PDOManager
// $pdom = Manager\PDOManager::getInstance();
// $resultat = $pdom -> getPdo() -> query("SELECT * FROM article");
// $articles = $resultat -> fetchAll(PDO::FETCH_ASSOC);

// echo '<pre>'; 
// print_r($articles);
// echo '</pre>';


// TEST 3 : Model
// $model = new Model\Model;

// Afficher tout :
// $articles = $model -> findAll();
// echo '<pre>';
// print_r($articles);
// echo '</pre>';

//Afficher un enregistrement : 
// $articles = $model -> find(6);
// echo '<pre>';
// print_r($articles);
// echo '</pre>';

//Ajouter un enregistrement : 
// $nouveauArticle = array(
	// 'id_article' => 4,
	// 'reference' => '1324',
	// 'categorie' => 'Paraluie',
	// 'titre' => 'super produit !',
	// 'description' => 'extra ! super produit pour cet été !',
	// 'taille' => 'L',
	// 'couleur' => 'blanc',
	// 'sexe' => 'm',
	// 'photo' => 'toto.jpg',
	// 'prix' => 12,
	// 'stock' => 50
// );
//$model -> register($nouveauArticle);

//Modifier un enregistrement : 
// $infos = array(
	// 'couleur' => 'Rouge',
	// 'sexe' => 'f'
// );
// $model -> update(6, $infos);
 
//Supprimer un enregistrement :
// $model -> delete(5);


// Test 4 : ArticleModel
$am = new Model\ArticleModel;

$produits = $am -> getAllArticles();
$produit = $am -> getArticleById(6);
$categories = $am -> getAllCategories();
$produit2 = $am -> getAllArticlesByCategorie('goodies');

echo '<pre>';
print_r($produit2);
echo '</pre>'; 





















