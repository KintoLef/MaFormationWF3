/*---------------------------
    LES SELECTEURS JQUERY
----------------------------*/

// -- Format : $("selecteur")
// -- En jQuery, tous les sélecteurs CSS sont disponibles...

// DOM Ready !
$(function() {

    //lesFlemmards.js
    function l(e) {
        console.log(e);
    };

    // -- Sélectionner les balises SPAN :

        // En JS :
        l("SPAN en JS :");
        l(document.getElementsByTagName("span"));

        // En jQuery :
        l("SPAN en jQuery :");
        l($("span"));

    // -- Sélectionner mon Menu

        // En JS :
        l("ID en JS :");
        l(document.getElementById("menu"));

        // En jQuery :
        l("ID en jQuery :");
        l($("#menu"));
    
    // -- Sélectionner par Classe

        // En JS :
        l("Classe en JS :");
        l(document.getElementsByClassName("MaClasse"));

        // En jQuery :
        l("Classe en jQuery :");
        l($(".MaClasse"));

    // -- Sélectionner par Attribut
    l("Par Attribut :");
    l($("[href='http://www.google.fr']"));
});