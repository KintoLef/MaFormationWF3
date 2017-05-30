/*---------------------------
    DISPONIBILITE DU DOM
----------------------------*/

/*
    A partir du moment où mon DOM, cad l'ensemble de l'arborescence de ma page
    est complètement chargé, je peux commencer à utiliser jQuery.

    Je vais mettre l'ensemble de mon code dans une fonction, cette fonction sera appelé
    AUTOMATIQUEMENT par jQuery lorque le DOM sera entièrement défini.

    3 façons de faire :
*/

    // -- 1
jQuery(document).ready(function(){
    // -- Ici, le DOM est entièrement chargé, je peux procéder à mon code JS.
});

    // -- 2
$(document).ready(function(){
    // -- Ici, le DOM est entièrement chargé, je peux procéder à mon code JS.
});

    // -- 3 (sans le (document).ready())
$(function(){
    // -- Ici, le DOM est entièrement chargé, je peux procéder à mon code JS.
    alert("Hello World !");

    // -- En JS :
    document.getElementById("TexteEnjQuery").innerHTML = "Mon Texte en JS";

    // -- En jQuery :
    $("#TexteEnjQuery").html("Mon Texte en jQuery !");
});