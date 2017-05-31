/*--------------------------------
    LES SELECTEURS D'ENFANTS
--------------------------------*/

// -- Initialisation de jQuery
$(function() {
    // -- Ici commence mon code jQuery
    // -- LesFlemmards.js
    function l(e) {
        console.log(e);
    }

    // -- Je souhaite sélectionner toutes mes divs
    l($("div"));

    // -- Je souhaite sélectionner mon header
    l($("header"));

    // -- Je souhaite sélectionner tous les éléments descendants direct (enfants) de mon "header"
    l($("header").children());

    // -- Je souhaite parmi mes descendants directs, uniquement les éléments <ul>
    l($("header").children("ul"));

    // -- Je souhaite récupérer tous les éléments <li> de mon <ul>
    l($("header").children("ul").find("li"));

    // -- Je souhaite récupérer uniquement le 2ème éléments de mes <li>
    l($("header").find("li").eq(1));

    // -- Je souhaite connaître le voisin immédiat de mon <header>
    l($("header").next());
    l($("header").next().next()); // -- Le voisin du voisin

    // -- Je souhaite connaître le parent de mon <header>
    l($("header").parent());

    // -- Je souhaite connaître le voisin d'avant mon <header>
    l($("header").prev());
});