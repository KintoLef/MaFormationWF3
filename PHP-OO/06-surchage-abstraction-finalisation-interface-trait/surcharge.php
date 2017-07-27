<?php
// 06-surchage-abstraction-finalisation-interface-trait/surchage.php

// Surcharge (Override): Permet de modifier le comportement d'une méthode héritée et d'y apporter des traitements supplémentaires.
// Surcharge != Redéfinition

class A
{
    public function calcul(){
        return 10;
    }
}

class B extends A
{
    public function calcul(){
        // return 15 (10+5)
        // return $this -> calcul() + 5; // Cela est récursif, car en utilisant $this -> la fonction fait donc appel à elle-même.
        
        return parent::calcul() + 5;
        // return A::calcul() + 5;
        // Avec les deux propositions ci-dessus, on fait réellement appel à la méthode de NOTRE PARENT (class A)
    }
}

/*
Commentaires:
    La surcharge est très utile dans le cadre de l'héritage, car elle permet d'ajouter (modifier) des traitements dans une méthode héritée.
    Par exemple, lorsque l'on travaille sur un CMS ou un FRAMEWORK, on n'a pas le droit de toucher aux fichiers de coeur de l'application, mais on peut hériter de certaines classes, et potentiellement modifier les traitements de certaines méthodes.
*/