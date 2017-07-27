<?php
//src/Entity/Article.php

namespace Entity;

class Article
{
	private $id_article;
	private $reference;
	private $categorie;
	private $titre;
	private $description;
	private $couleur;
	private $taille;
	private $sexe;
	private $photo;
	private $prix;
	private $stock;
	
	
	public function getId_article(){
		return $this -> id_article;
	}
	public function setId_article($arg){
		$this -> id_article = $arg;
	}
	
	public function getReference(){
		return $this -> reference;
	}
	public function setReference($arg){
		$this -> reference = $arg;
	}
	
	public function getCategorie(){
		return $this -> categorie;
	}
	public function setCategorie($arg){
		$this -> categorie = $arg;
	}
	
	public function getDescription(){
		return $this -> description;
	}
	public function setDescription($arg){
		$this -> description = $arg;
	}
	
	
	public function getCouleur(){
		return $this -> couleur;
	}
	public function setCouleur($arg){
		$this -> couleur = $arg;
	}
	
	public function getTaille(){
		return $this -> taille;
	}
	public function setTaille($arg){
		$this -> taille = $arg;
	}
	
	public function getTitre(){
		return $this -> titre;
	}
	public function setTitre($arg){
		$this -> titre = $arg;
	}
	
	public function getSexe(){
		return $this -> sexe;
	}
	public function setSexe($arg){
		$this -> sexe = $arg;
	}
	
	public function getPhoto(){
		return $this -> photo;
	}
	public function setPhoto($arg){
		$this -> photo = $arg;
	}
	
	public function getPrix(){
		return $this -> prix;
	}
	public function setPrix($arg){
		$this -> prix = $arg;
	}
	
	public function getStock(){
		return $this -> stock;
	}
	public function setStock($arg){
		$this -> stock = $arg;
	}
}