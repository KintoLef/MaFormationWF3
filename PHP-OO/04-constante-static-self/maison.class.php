<?php
// 04-constante-static-self/maison.class.php

class Maison
{
    public $couleur = 'blanc'; // Appartient à l'objet
    public static $espaceTerrain = '500m²'; // Appartient à la classe
    private $nbPorte = 10; // Appartient à l'objet
    private static $nbPiece = 7; // Appartient à la classe
    const HAUTEUR = '10m'; // Appartient à la classe

    public function getNbPorte(){
        return $this -> nbPorte;
    }

    public static function getNbPiece(){
        return self::$nbPiece;
    }

}
echo 'Terrain: ' . Maison::$espaceTerrain . '<br>'; // Ok j'accède à un élément de la classe par la classe
echo 'Nb de Pieces: ' . Maison::getNbPiece() . '<br>'; // Ok j'accède à un élément private de la classe via un getter appartenant à la classe
echo 'Hauteur: ' . Maison::HAUTEUR . '<br>'; // Ok j'accède à un élément appartenant à la classe via la classe





//--------------------------------------------------------

$maison = new Maison;
echo 'Couleur: ' . $maison -> couleur . '<br>'; // Ok j'accède à une propriété public via l'objet
// echo 'Terrain: ' . $maison -> espaceTerrain . '<br>'; // Erreur: j'essaie d'accéder à une propriété appartenant à la calsse par l'objet.
// echo 'Nb de portes' . $maison -> nbPorte . '<br>'; // Erreur: private donc nécéssite getter
echo 'Nb de portes: ' . $maison -> getNbPorte() . '<br>'; // Ok j'accède à un élément appartenant à l'objet, et private, via un getter appartenant à l'objet

/*
Commentaires:
    Opérateurs:
        $objet ->   : Permet d'accéder à l'élément d'un objet à l'extérieur de la classe
        $this ->    : Permet d'accéder à l'élément d'un objet à l'interieur de la classe
        Class::     : Permet d'accéder à l'élément d'une classe à l'extérieur de la classe
        self::      : Permet d'accéder à l'élément d'une classe à l'interieur de la classe

    2 questions à se poser:
        - Est-ce que l'élément est static ?
            -> Si oui: Class:: / self::
                - Suis-je à l'intérieur ou à l'extérieur de la classe ?
                    -> Intérieur: self::
                    -> Extérieur: Class::
            -> Si non: $objet-> / $this->
                - Suis-je à l'intérieur ou à l'extérieur de la classe ?
                    -> Intérieur: $this->
                    -> Extérieur: $objet->

    Static signifie qu'un élément appartient à la classe. Pour y accéder on devra donc l'appeler par la classe (Class:: ou self::). Une propriété peut être modifiée, et tous les objets qui suivront auront la nouvelle valeur (exemple: singleton).

    Const signifie qu'une propriété appartient à la classe et qu'elle ne peut être modifiée.
*/
