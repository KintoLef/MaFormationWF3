// -- Initialisation de jQuery
$(function() {
        
    $("#adopt-form").on("submit", function(event) {
        
        event.preventDefault();

        // -- Déclaration des variables
        var select   = $("#choixchat");
        var message  = $("#message");

        $("#adopt-form .has-error").removeClass("has-error");
        $("#adopt-form .text-danger").remove();

        // -- Je passe à la vérification de chaque champs

            // -- 1. Vérification du champ Choix du Chat
            if(select.val() === null) {
                select.parent().addClass("has-error");

                $("<p class='text-danger'>Vous devez choisir un chat</p>").appendTo(select.parent());
            };
            
            // -- 2. Vérification du Message (textarea)
            if(message.val().length < 15) {
                message.parent().addClass("has-error");
                $("<p class='text-danger'>Vous devez saisir un minimum de 15 caractères</p>").appendTo(message.parent());
            };

            
        if($(this).find(".has-error"). length == 0) {
            $(this).replaceWith("<div class='alert alert-success'>Votre demande d'adoption à été transmise. Après étude de celle-ci, vous recevrez une réponse sous 15 jours.</div>");
        }        
    });
    
    // -- Suppression des différentes erreurs
    $("#adopt-form #choixchat").on("focus", function() {
        $("#adopt-form .selectchat .has-error").removeClass("has-error");
        $("#adopt-form .selectchat .text-danger").remove();
    });

    $("#adopt-form #message").on("keyup", function() {
        $("#adopt-form .messagechat .has-error").removeClass("has-error");
        $("#adopt-form .messagechat .text-danger").remove();
    });
});