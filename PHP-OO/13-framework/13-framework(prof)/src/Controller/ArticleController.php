<?php
//src/Controller/ArticleController.php

namespace Controller; 

class ArticleController extends Controller
{
	//Via l'hérite avec Controller j'ai accès à getModel() et à render().
	
	// Affichage de la page boutique :
	public function afficheAll(){
		//1 : Récupérer tous les produits
		//2 : Récupérer toutes les categories
		//3 : Envoyer la vue boutique.php
		
		$articles = $this -> getModel() -> getAllArticles();
		$categories = $this -> getModel() -> getAllCategories();
		
		
		$params = array(
			'articles' => $articles,
			'categories' => $categories,
			'title' => 'Ma super Boutique'
		);
		
		return $this -> render('layout.html', 'boutique.html', $params);	
	}	
	
	// Affichage d'une page article : 
	public function affiche($id){
		//1 : Récupérer l'article
		//1.2 : Récupérer toutes les suggestions
		//2 : Afficher la vue fiche_article.php 
		
		$article = $this -> getModel() -> getArticleById($id);
		
		$params = array(
			'article' => $article,
			'title' => 'Produit : ' . $article -> getTitre() 
		);
		
		return $this -> render('layout.html', 'fiche_article.html', $params);
	}
	

	
	// Affichage des articles d'une categorie:
	public function categorie($categorie){
		//1 : Récupérer tous les articles d'une categorie
		//2 : Récupérer toutes les catégories
		//3 : Afficher la vue boutique.php
		
		$articles = $this -> getModel() -> getAllArticlesByCategorie($categorie);
		$categories = $this -> getModel() -> getAllCategories();
		
		$params = array(
			'articles' => $articles,
			'categories' => $categories,
			'title' => 'Categorie de produit :' . $categorie
		);
		
		return $this -> render('layout.html', 'boutique.html', $params);
	}
	
	public function rechercher($term){
		
		$articles = $this -> getModel() -> findSearch($term);
		$categories = $this -> getModel() -> getAllCategories();
		
		$params = array(
			'articles' => $articles,
			'categories' => $categories,
			'nbArticle' => sizeof($articles),
			'title' => 'Recherche :' . $term
		);
		
		return $this -> render('layout.html', 'recherche.html', $params);
		
		
	}
	
	
	
	
	
	
	
}