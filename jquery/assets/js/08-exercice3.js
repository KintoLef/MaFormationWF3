function validateEmail(email){
	var emailReg = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
	var valid = emailReg.test(email);

	if(!valid) {
        return false;
    } else {
    	return true;
    }
};

var Contacts = [];

// -- Initialisation de jQuery
$(function() {
    
    $("#contact").on("submit", function(event) {
    event.preventDefault();

        // -- Déclaration des variables (champs à vérifier)
        var nom     = $("#nom");
        var prenom  = $("#prenom");
        var email   = $("#email");
        var tel     = $("#tel");
        var message = $("#message");


        /* -------------------------------
            DECLARATION DES FONCTIONS
        -------------------------------- */

        //-- Fonction ajouterContact(Contact) : Ajouter un Contact dans le tableau de Contacts, mettre à jour le tableau HTML, réinitialiser le formulaire et afficher une notification.
        function ajouterContact(Contact) {
            Contacts.push(Contact);
            $(".aucuncontact").remove();
            $("tbody").append("<tr><td>" + Contact.nom + "</td><td>" + Contact.prenom + "</td><td>" + Contact.email + "</td><td>" + Contact.tel + "</td></tr>"); 
            afficheUneNotification();
            reinitialisationDuFormulaire();     
        };

        // -- Fonction RéinitialisationDuFormulaire() : Après l'ajout d'un contact, on remet le formulaire à 0 !
        function reinitialisationDuFormulaire() {
            $("#contact")[0].reset(); // -- Ici on réinitialise le formulaire
        };

        // -- Affichage d'une notification
        function afficheUneNotification() {
            $(".alert-contact").css("display", "block");
        };

        // -- Vérification de la présence d'un contact dans contacts
        function PresenceContact(Contact) {
            for(i=0; i<Contacts.length; i++) {
                var inscrits = Contacts[i];

                if(inscrits.email === Contact.email) { // -- Ici la fonction va checker toutes les valeurs des champs email et si elle trouve à email identique à celui rentré par l'utilisateur elle va retourner vrai
                    return true;
                } 
                if( i == Contacts.length - 1) { //-- Ici on créer une condition qui dit qu'arriver à la dernière ligne du tableau si la fonction n'a rien trouver elle retourne la valeur false.
                    return false;
                };
            };
        };

        // -- Suppression des différentes erreurs
        $("#contact .has-error").removeClass("has-error");
        $("#contact .text-danger").remove();
        $("#contact .alert-danger").remove();

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

            // -- 5. Vérification du Message
            if(message.val().length < 15) {
                message.parent().addClass("has-error");
                $("<p class='text-danger'>Le champ doit contenir un minimum de 15 caractères !</p>").appendTo(message.parent());
            };

        if($(this).find(".has-error"). length == 0) {
            let Contact = { // -- On crée un objet qui servira à alimenter le tableau Contacts
                "nom"   : nom.val(),
                "prenom": prenom.val(),
                "email" : email.val(),
                "tel"   : tel.val(),
            };

            PresenceContact(Contact);
            if (!PresenceContact(Contact)) { // -- Si la fonction retourne false (avec !) alors on execute les autres fonctions pour ajouter le contact, faire la notification, et réinitialiser le formulaire
                ajouterContact(Contact);
            } else { // -- Si la fonction retourne vrai alors on affiche un message d'alerte
                $("#contact").prepend("<div class='alert alert-danger'><p>Ce contact existe déjà !</p></div>");
                $(".alert-contact").css("display", "none");
                reinitialisationDuFormulaire()
            }
            console.log(Contacts);
        };
    });
});