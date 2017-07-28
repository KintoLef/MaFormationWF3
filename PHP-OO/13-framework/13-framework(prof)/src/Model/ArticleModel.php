<?php

//src/Model/ArticleModel.php

namespace Model;

use PDO;

class ArticleModel extends Model
{
	public function getAllArticles(){
		return $this -> findAll();
	}
	
	public function getArticleById($id){
		return $this -> find($id);
	}
	
	public function deleteArticleById($id){
		return $this -> delete($id);
	}
	
	public function updateArticleById($id, $infos){
		return $this -> update($id, $infos);
	}
	
	public function registerArticle($infos){
		return $this -> register($infos);
	}
	
	//----------------------------
	
	// requete qui récupere toutes les catégories : 
	public function getAllCategories(){
		$requete = "SELECT DISTINCT categorie FROM article";
		$resultat = $this -> getDb() -> query($requete);
		
		$categories = $resultat -> fetchAll(PDO::FETCH_ASSOC);
		
		if(!$categories){
			return false;
		}
		else{
			return $categories;
		}	
	}
	
	// requete qui récupère toutes les enregistrements de la table article en fonction de la catégorie
	public function getAllArticlesByCategorie($categorie){
		$requete = "SELECT * FROM article WHERE categorie = :categorie";
		
		$resultat = $this -> getDb() -> prepare($requete);
		$resultat -> bindParam(':categorie', $categorie, PDO::PARAM_STR);
		$resultat -> execute();

		$resultat -> setFetchMode(PDO::FETCH_CLASS, 'Entity\Article');

		$articles = $resultat -> fetchAll();
		
		if(!$articles){
			return false;
		}
		else{
			return $articles;
		}
	
	}
	
	// requete pour récupérer les resultats de recherche
	public function findSearch($term){
		$term = '%' . $term . '%';
		
		$requete="
			SELECT *
			FROM article
			WHERE titre LIKE :valeur
			OR description LIKE :valeur
			OR categorie LIKE :valeur
			OR couleur LIKE :valeur
			OR taille LIKE :valeur
		";
		
		$resultat = $this -> getDb() -> prepare($requete);
		$resultat -> bindParam(':valeur', $term);
		$resultat -> execute();
		
		$resultat -> setFetchMode(PDO::FETCH_CLASS, 'Entity\Article');
		
		$donnees = $resultat -> fetchAll();
		
		if(!$donnees){
			return FALSE;
		}
		else{
			return $donnees;
		}	
		
	}
	
	
	
	
	
	
}