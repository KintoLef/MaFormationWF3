// -- Déclarer un Tableau Numérique.
var monTableau = [];
var myArray    = new Array; // -- en anglais

// -- Affecter des Valeurs à un Tableau Numérique.
monTableau[0] = "Hugo";
monTableau[1] = "Tanguy";
monTableau[2] = "Géraldine";

// -- Afficher le contenu de mon Tableau Numérique dans la console.
console.log(monTableau[0]); // -- Hugo
console.log(monTableau[2]); // -- Géraldine
console.log(monTableau); // -- Affiche toutes les données du tableau

// -- Déclarer et Affecter des Valeurs à un Tableau Numérique.
var NosPrenoms = ["Yimin","Alex", "Cristian", "Tristan"];
console.log(NosPrenoms);
console.log(typeof NosPrenoms);

// -- Déclarer et Affecter des Valeurs à un Objet. (Pas de Tableaux Associatifs en JS)
var Coordonnee = {
    "prenom"    :   "Hugo",
    "nom"       :   "LIEGERAD",
    "age"       :   27,
}

console.log(Coordonnee);
console.log(typeof Coordonnee);

// -- Comment créer et affecter des valeurs à un Tableau 2D.

// -- Je vais créer 2 tableaux numériques
var listeDePrenoms = ["Hugo", "Rodrigue", "Kristie"];
var listeDeNoms    = ["LIEGEARD", "NOUEL", "SOUKAI"];

// -- Je vais créer un tableau 2D à partir de mes 2 tableaux précédents.
var Annuaire = [listeDePrenoms, listeDeNoms];
console.log(Annuaire);

// -- Afficher unNom et un Prénom sur ma page HTML
document.write(Annuaire[0][1]);
document.write(" ");
document.write(Annuaire[1][1]);
document.write(" ");

/* ---------------------------------------------------------------\
|    EXERCICE :                                                   |
|                                                                 |
|    Créer un Tableau 2D appelé "AnnuaireDesStagiaires"           |
|    qui contiendra toutes les coordonnées pour chaque stagiaire. |
|                                                                 |
|    Ex: Nom, Prénom, Tel...                                      |
\--------------------------------------------------------------- */

var Noms    = ["LEFEVRE", "PERON", "NOUEL", "SOUKAI"];
var Prenoms = ["Quentin", "Philippe", "Rodrigue", "Kristie", ]
var Age     = ["27", "48", "32", "29",]
var Tel     = ["06.xx.xx.xx.xx", "06.xx.xx.xx.xx", "06.xx.xx.xx.xx", "06.xx.xx.xx.xx",]
var Adresse = ["1 rue blabla", "34 rue blabla", "18 avenue blabla", "68 blvd blabla",]
var AnnuaireDesStagiaires = [Noms, Prenoms, Age, Tel, Adresse];
console.log(AnnuaireDesStagiaires);

// -- CORRECTION (façon JSon)
var AnnuaireDesStagiaires=[
    {"prenom":"Quentin",    "nom":"LEFEVRE",     "tel": "06.xx.xx.xx.xx"},
    {"prenom":"Hugo",       "nom":"LIEGEARD",    "tel": "06.xx.xx.xx.xx"},
    {"prenom":"Tanguy",     "nom":"MANAS",       "tel": "06.xx.xx.xx.xx"},
];
console.log(AnnuaireDesStagiaires);
console.log(AnnuaireDesStagiaires[0].prenom); // -- Quentin
console.log(AnnuaireDesStagiaires[1].prenom); // -- Hugo

/* -------------------------------
        AJOUTER UN ELEMENT
---------------------------------*/

var Couleurs = ["Rouge", "Jaune", "Vert"];

// -- Si je souhaite ajouter un élément dans mon tableau
// -- Je fait appel à la fonction push() qui me renvoi le nombres d'éléments de mon tableau

console.log(Couleurs);
var nombreElementsDeMonTableau = Couleurs.push("Orange");
console.log(Couleurs);
console.log(nombreElementsDeMonTableau);

// -- NB: La Fonction unshift() permet d'ajouter un ou plusieurs éléments en début de tableau.

/* -----------------------------------------
    RECUPERER ET SORTIR LE DERNIER ELEMENT
-------------------------------------------*/

// -- La fonction pop() me permet de supprimer le dernier élément de mon tableau et
// -- d'en récupérer la valeur.
// -- Je peux accessoirement récupérer cette valeur dans une variable.

var monDernierElement = Couleurs.pop();
console.log(monDernierElement);
console.log(Couleurs);

// -- La même chose est possible avec le premier élément en utilisant la fonction shift()
// -- NB: La fonction splice() vous permet de faire sortir un ou plusieurs éléments du tableau.