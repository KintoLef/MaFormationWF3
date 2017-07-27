<?php
// 06-surchage-abstraction-finalisation-interface-trait/trait.php

// Attention !! - Les traits ne fonctionnent que depuis PHP5.4

trait TPanier
{
    public function affichageProduit(){
        return 'Voici les produits dans le panier !';
    }
}

trait TMembre
{
    public function affichageMmebre(){
        return 'Voici le membre !';
    }
}

class Site
{
    use TPanier;
    use TMembre;
    // use TPanier, TMembre;
    // Cela importe le code présent dans TPanier et TMembre
}

/*
Commentaires:
    - Les traits ont été inventés pour repousser les limites de l'héritage non multiple du PHP
    - Une classe peut hériter d'une seule classe, mais elle peut importer plusieurs traits
    - Un trait peut importer un autre trait
*/