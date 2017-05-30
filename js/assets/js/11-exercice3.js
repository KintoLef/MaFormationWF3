/* CONSIGNE : A partir du tableau fourni, vous devez mettre en place un système d'authentification. Après avoir demandé à votre utilisateur son EMAIL et MOT DE PASSE, et après avoir vérifié ses informations, vous lui souhaiterez la bienvenue avec son nom et prénom (document.write);
En cas d'échec, vous afficherez une ALERT pour l'informer de l'erreur. */

var BaseDeDonnees = [
{"prenom":"Hugo", "nom":"LIEGEARD", "email":"wf3@hl-media.fr", "mdp":"wf3"},
{"prenom":"Rodrigue", "nom":"NOUEL", "email":"rodrigue@hl-media.fr", "mdp":"wf3"},
{"prenom":"Nathanael", "nom":"DORDONNE", "email":"nathanael.d@hl-media.fr", "mdp":"wf3"}
];

var mail = prompt("Veuillez indiquer votre email", "adresse@google.fr");
var motdepasse = prompt("Veuillez indiquer votre motdepasse", "xxxxxxxx");

for(var i=0; i<BaseDeDonnees.length; i++) {
    var login = BaseDeDonnees[i];

    if(mail === login.email && motdepasse === login.mdp) {
        document.write("Bonjour " + login.prenom + " " + login.nom);
        break;
    }
}
if(mail !== login.email && motdepasse !== login.mdp) {
    alert("Les identifiants sont incorrects");
};
