/* -------------------------
        LES EVENEMENTS
----------------------------|

Les évènements, vont permettre de déclencher
une fonction, c'est-à-dire : une série d'instructions,
suite à une action de mon utilisateur.

OBJECTIF : Etre en mesure de capturer ces évènements,
afin d'exécuter une fonction.

Les Evenements : MOUSE (Souris)

    click       : au clic sur un élément
    mouseenter  : la souris passe au dessus de la zone qu'occupe un élément
    mouseleave  : la souris sort de cette zone

Les Evenements : KEYBOARD (Clavier)

    keydown : une touche du clavier est enfoncé
    keyup   : une touche a été relaché

Les Evenements : WINDOW (Fenêtre)

    scroll  : défilement de la fenêtre
    resize  : redimensionnement de la fenêtre

Les Evenements : FORM (formulaire)

    change  : pour les éléments <input>, <select> et <textarea>
    submit  : à l'envoi d'un formulaire

Les Evenements : DOCUMENT

    DOMContentLoaded    :   Exécuté lorsque le document HTML est complètement chargé, sans attendre le CSS et les Images.

*/

/* ---------------------------------
        LES ECOUTEURS D'EVENEMENTS
------------------------------------|

Pour attacher un évènement à un élément, ou autrement dit,
pour déclarer un écouteur d'évènement qui se chargera de lancer
une action, c'est-à-dire une fonction pour un évènement donné,
je vais utiliser la syntaxe suivante :

*/

var p = document.getElementById("MonParagraphe")
console.log(p);

// -- Je souhaite que mon paragraphe soit rouge au clic de la souris.

    // -- 1 : Je définis une fonction chargée d'exécuter cette action.
    function changeColorToRed() {
        p.style.color = "red";
    }

    // -- 2 : Je déclare un écouteur qui se chargera d'appeler la fonction au déclenchement de l'évènement.
    p.addEventListener("click", changeColorToRed);

/* ------------------------
    EXERCICE PRATIQUE
A l'aide de javascript, créez un champ "input" type text avec un ID unique.
Affichez ensuite dans une alerte, la saisie de l'utilisateur.
--------------------------- */

var input = document.createElement("input");
input.id = "MonInput";
input.type = "text";
input.setAttribute("placeholder", "Saisie texte...");
document.body.appendChild(input);

input.addEventListener("change", retourSaisie);

function retourSaisie(){
    alert(input.value)
};

