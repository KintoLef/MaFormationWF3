<?php
// 05-heritage/heriatge_sens.php

// transitivité: Si B hérite de A et que C hérite de B, alors C hérite de A.

Class A
{
    public function test(){
        return 'test';
    }
}
Class B extends A
{
    public function test2(){
        return 'test2';
    }
}
Class C extends B
{
    public function test3(){
        return 'test3';
    }
}
//----------------------------------

$c = new C;
echo $c -> test();  // Méthode de A accessible par C (héritage indirect)
echo $c -> test2(); // Méthode de B accessible par C (héritage)
echo $c -> test3(); // Méthode de C accessible par C

var_dump(get_class_methods($c)); // Nous retourne tes, test2, test3...

/*
Commentaires:
    Transitivité:
        Si B hérite de A...
            Et que C hérite de B...
                Alors C hérite de A (indirectement)
    --> Les méthodes protected de A sont également accessibles dans C (pourtant l'héritage est indirecte).

    L'héritage n'est pas:
        -> Reflexif: Class D extends D: ce n'est pas possible, une classe ne peut pas hériter d'elle-même.
        -> Symétrique (réciproque): Ce n'est pas parce que Class E extends F, que F extends E automatiquement.
        -> Multiple: Class N extends O, M: En PHP ce n'est pas possible. Pas d'héritage multiple en PHP, mais existe dans d'autres langages.

    Une classe peut avoir un nombre infini d'héritiers.
*/