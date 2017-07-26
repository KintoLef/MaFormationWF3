<?php
// 03-manipulation-type-argument/exercice3.php

/* Consignes:
    1- Création d'un véhicule
    2- Attribuer un nombre de litre d'essence au véhicule (5L)
    3- Afficher le nombre de litre d'essence dans le véhicule
    4- La capacité max du réservoir du véhicule est de 50L (50)
    5- Création d'une pompe
    6- Attribuer un nombre de litre d'essence à la pompe (800L)
    7- Afficher le nombre de litre d'essence dans la pompe
    8- La pompe donne de l'essence au véhicule et fait le plein
    9- Afficher le nombre de litre d'essence dans le véhicule après ravitaillement
    10- Afficher le nombre de litre d'essence dans la pompe apères ravitaillement
    
    !! Le véhicule ne peut pas recevoir plus que la capacité max de son réservoir !!
*/

class Vehicule
{
    private $litreEssence; // 5 contenu à un instant t
    private $reservoir; // 50 capacité max du réservoir

    public function getLitreEssence(){
        return $this -> litreEssence;
    }

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    public function getReservoir(){
        return $this -> reservoir;
    }

    public function setReservoir($litre){
        $this -> reservoir = $litre;
    }
}

class Pompe
{
    private $litreEssence; // 800 contenu à un instant t

    public function getLitreEssence(){
        return $this -> litreEssence;
    }

    public function setLitreEssence($litre){
        $this -> litreEssence = $litre;
    }

    // Fonction pour la consigne 8...
    public function ravitaillementVehicule(Vehicule $v){
        $plein = $v -> getReservoir() - $v -> getLitreEssence(); // plein = 50 - 5 = 45
        $v -> setLitreEssence($v -> getLitreEssence() + $plein); // $v litre essence = 5 + 45 = 50
        $this -> setLitreEssence($this -> getLitreEssence() - $plein); // $pompe($this) litre essence = 800 - 45 = 755    
    }
}

$vehicule = new Vehicule;
$vehicule -> setLitreEssence(5);
echo 'Le véhicule a ' . $vehicule -> getLitreEssence() . 'L d\'essence<br>';

$vehicule -> setReservoir(50);
echo 'La capacité max du réservoir du véhicule est de ' . $vehicule -> getReservoir() . 'L<br><br>';

$pompe = new Pompe;
$pompe -> setLitreEssence(800);
echo 'La pompe a ' . $pompe -> getLitreEssence() . 'L d\'essence<br><br>';

$pompe -> ravitaillementVehicule($vehicule);
echo 'Après ravitaillement, le véhicule a ' . $vehicule -> getLitreEssence() . 'L d\'essence<br>';
echo 'Après ravitaillement, la pompe a ' . $pompe -> getLitreEssence() . 'L d\'essence<br>';