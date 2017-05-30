// alert("WOW ! Tu es sur ma page !");

// Deux slash pour faire un commentaire uniligne.

/* 
    Ici, je peux faire un commentaire
    sur plusieurs lignes.

    RACCOURCI: Ctrl + / (plusieurs lignes)
            ou Ctrl + Shift + / (uniligne)
*/

// -- 1 : Déclarer une variable en JS.
var Prenom;

// -- 2 : Affecter une Valeur.
Prenom="Quentin";

// -- 3 : Afficher la Valeur de ma Variable dans la console.
console.log(Prenom);

/*----------------------------------------------
| ~ ~ ~ ~ ~  LES TYPES DE VARIABLES  ~ ~ ~ ~ ~ |
----------------------------------------------*/

// -- Ici, typeof me permet de connaître le type de ma variable.
console.log(typeof Prenom);

// -- Déclaration d'un Nombre
var Age= 26;

// -- Afficher dans la console
console.log(Age);

// -- Connaître son type
console.log(typeof Age);

            /*-----------------------------------------------------|
            |               LA PORTEE DES VARIABLES                |
            |                                                      |
            |   Les Variables déclarées directement à la racine    |
            |   du fichier JS sont appelés variables GLOBALES.     |
            |                                                      |
            |   Elles sont disponibles dans l'ensemble de votre    |
            |   document, y compris dans les fonctions.            |
            |                                                      |
            |   ###                                                |
            |                                                      |
            |   Les Variables déclarées à l'intérieur d'une        |
            |   fonction sont appelées variables LOCALES.          |
            |                                                      |
            |   ###                                                |
            |                                                      |
            |   Depuis ECMA6, vous pouvez déclarer une variable    |
            |   avec le mot-clé "let".                             |
            |                                                      |
            |   Votre variable sera alors accessible uniquement    |
            |   dans le bloc dans lequel elle est contenu cad      |
            |   déclarée.                                          |
            |                                                      |
            |   Si elle est déclarée dans une condition, elle      |
            |   sera disponible uniquement dans le bloc de la      |
            |   condition.                                         |
            |-----------------------------------------------------*/

// -- Les Variables FLOAT
var uneDecimale= -2.984;
console.log(uneDecimale);
console.log(typeof uneDecimale);

// -- Les Booléens (VRAI / FAUX)
var unBooleen = false; // -- true
console.log(unBooleen);
console.log(typeof unBooleen);

// -- Les Constantes

/*
    La déclaration CONST permet de créer une constante accessible uniquement en lecture.
    Sa valeur, ne pourra pas être modifiée par des réaffectations ultérieures.
    Une constante ne peut pas être déclarée à nouveau.
*/

// Généralement, par convention, les constantes sont en majuscules.

const HOST = "localhost";
const USER = "root";
const PASSWORD = "mysql";

// -- Je ne peux pas faire cela :
// USER = "Hugo";
// Uncaught TypeError: Assignment to constant variable.

            /*-----------------------------------------------------|
            |                    LA MINUTE INFO                    |
            |                                                      |
            |   Au fur et à mesure que l'on affecte ou ré-affecte  |
            |   des valeurs à une variable, celle-ci prend la      |
            |   nouvelle valeur et le nouveau type.                |
            |                                                      |
            |   En JavaScript (ECMA Script); les variables sont    |
            |   auto-typées                                        |
            |                                                      |
            |    Pour convertir une variable de type NUMBER en     |
            |   STRING et STRING, en NUMBER je peux utiliser les   |
            |   fonction natives de JavaScript.                    |
            |                                                      |
            |-----------------------------------------------------*/

var unNombre = "27";
console.log(unNombre);
console.log(typeof unNombre);

// -- La fonction parseInt() pour retourner un Entier à partir de ma chaîne de caractère.
unNombre = parseInt(unNombre);
console.log(unNombre);
console.log(typeof unNombre);

// -- Je ré-affecte une valeur à ma variable
unNombre = "12.55";
console.log(unNombre);
console.log(typeof unNombre);

// -- La fonction parseFloat() permet de retourner un Float sur la Base d'un STRING
unNombre = parseFloat(unNombre);
console.log(unNombre);
console.log(typeof unNombre);

// -- Conversion d'un Nombre en STRING avec toString()
var unNombreEnString = 10;
var maChaineDeCaractere = unNombreEnString.toString();
console.log(unNombreEnString);
console.log(typeof unNombreEnString);
console.log(typeof maChaineDeCaractere);