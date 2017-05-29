/* -----------------------
      LES FONCTIONS
----------------------- */

// -- Déclarer une fonction
// -- Cette fonction ne retourne aucune valeur
function DisBonjour() {
    // Lors de l'appel de la fonction, les instructions ci-dessous seront exécutées.
    alert("Bonjour !");
}

//  -- Je vais appeler ma fonction "DisBonjour" et déclencher ses instructions.
DisBonjour();

// -- Déclarer une fonction qui prend une variable en paramètre
function Bonjour(Prenom, Nom) {
    document.write("<p>Hello <strong> " + Prenom + " " + Nom + "</strong> !</p>");
}

// -- Appeler / Utiliser une fonction avec un Paramètre
Bonjour("Quentin", "LEFEVRE");

// -- OU
var Prenom  =   "Quentin";
var Nom     =   "LEFEVRE";

Bonjour(Prenom, Nom);

/* ------------------------
    EXERCICE:
    Créez une fonction permettant d'effectuer l'addition de deux nombres passés en paramètre.
------------------------- */

function Addition(nb1, nb2) {
    // let resultat = nb1 + nb2;
    // -- Le Mot Clé "return" permet de renvoyer une valeur en sortie.
    return nb1 + nb2; // resultat;
}

document.write("<p>" + Addition(10, 5) + "</p>");