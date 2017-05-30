/*-----------------------------------
    LE CHAINAGE DE METHODE JQUERY
------------------------------------*/

$(function() {
    // -- Je souhaite cacher toutes les div de ma page HTML
    $("div").hide("slow", function() {
        // -- Une fois que la méthode hide() est terminée, mon alerte peut s'exécuter.
        alert("Fin du Hide");
        // -- NB : La fonction s'exécutera pour l'ensemble des éléments du sélecteur.

        // -- CSS
        $("div").css("background", "yellow");
        $("div").css("color", "red");

        // -- Je fais réapparaître mes divs
        $("div").show();

    }); // -- Fin de la fonction anonyme

    // -- En utilisant le chaînage de méthodes, vous pouvez faire s'enchaîner plusieurs 
    // fonction les unes après les autres...

    $("p").hide(2000).css("color", "blue").css("font-size", "20px").delay(2000).show(500);

    // -- MAIS, C'EST ENCORE TROP LONG !!!!!!!!!!!!
    $("p").hide(2000).css({"color": "blue", "font-size": "20px"}).delay(2000).show(500);

});