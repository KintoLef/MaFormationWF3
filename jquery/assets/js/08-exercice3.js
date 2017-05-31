function validateEmail(email){
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);

	if(!valid) {
        return false;
    } else {
    	return true;
    }
};

// -- Initialisation de jQuery
$(function() {
    var Contacts = [];
    $("#contact").on("submit", function(event) {
    event.preventDefault();

        // -- Déclaration des variables (champs à vérifier)
        var nom     = $("#nom");
        var prenom  = $("#prenom");
        var email   = $("#email");
        var tel     = $("#tel");


        /* -------------------------------
            DECLARATION DES FONCTIONS
        -------------------------------- */

        //-- Fonction ajouterContact(Contact) : Ajouter un Contact dans le tableau de Contacts, mettre à jour le tableau HTML, réinitialiser le formulaire et afficher une notification.
        function ajouterContact(Contact) {
            Contacts.push(Contact);
        };

        // -- Fonction RéinitialisationDuFormulaire() : Après l'ajout d'un contact, on remet le formulaire à 0 !
        function reinitialisationDuFormulaire() {
            $("#contact")[0].reset();
        };

        // -- Affichage d'une notification
        function afficheUneNotification() {
            $(".alert-contact").css("display", "block");
        };

        // -- Vérification de la présence d'un contact dans contacts
        function PresenceContact(Contact) {
            for(i=0; i<Contacts.length; i++) {
                var inscrits = Contacts[i];

                if(email.val() === inscrits.email) {
                    alert("Cet email à déjà été enregistré");
                } else {
                    ajouterContact(Contact);
                };
            };
        };

        // -- Suppression des différentes erreurs
        $("#contact .has-error").removeClass("has-error");
        $("#contact .text-danger").remove();

        // -- Je passe à la vérification de chaque champs

            // -- 1. Vérification du Nom
            if(nom.val() == "") {
                nom.parent().addClass("has-error");
                $("<p class='text-danger'>N'oubliez pas de saisir votre nom</p>").appendTo(nom.parent());
            };
            
            // -- 2. Vérification du Prenom
            if(prenom.val().length == 0) {
                prenom.parent().addClass("has-error");
                $("<p class='text-danger'>N'oubliez pas de saisir votre prenom</p>").appendTo(prenom.parent());
            };

            // -- 3. Vérification du Mail
            if(!validateEmail(email.val())){
                email.parent().addClass("has-error");
                $("<p class='text-danger'>Vérifier votre adresse email</p>").appendTo(email.parent());
            };

            // -- 4. Vérification du Tel
            if(tel.val() == "" || $.isNumeric(tel.val()) == false) {
                tel.parent().addClass("has-error");
                $("<p class='text-danger'>Vérifier votre numéro de téléphone</p>").appendTo(tel.parent());
            };

        if($(this).find(".has-error"). length == 0) {
            let Contact = {
                "nom"   : nom.val(),
                "prenom": prenom.val(),
                "email" : email.val(),
                "tel"   : tel.val(),
            };

            PresenceContact(Contact);
            ajouterContact(Contact);
            console.log(Contacts);
            afficheUneNotification();
            reinitialisationDuFormulaire();
        };
    });
});