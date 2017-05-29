/* -----------------------
      LES CONDITIONS
----------------------- */

var MajoriteLegaleFR = 18;

if(MajoriteLegaleFR >= 18) {
    alert("Bienvenu !");
} else {
    alert("Google...");
}

/* ------------------------
    EXERCICE:
    Créez une fonction permettant de vérifier l'âge d'un visiteur (prompt).
    S'il a la majorité légale, alor je lui souhaite la bienvenue,
    sinon, je fait une redirection sur Google après lui avoir signalé le soucis.
------------------------- */

var MajoriteLegaleFR = 18;

function verifierAge() {
    return parseInt(prompt("Votre Age", "Age"));
}

if(verifierAge() >= MajoriteLegaleFR) {
    alert("Bienvenu sur mon site !");
} else {
    alert("Tu n'as pas l'âge requis pour accéder à ce contenu !", document.location.href="http://localhost/formation/javascript/08-LesConditions.html");
}

/* --------------------------------------
      LES OPERATEURS DE COMPARAISON
-------------------------------------- */

// -- L'Opérateur de Comparaison "==" signifie : égal à ...
// Il permet de vérifier que deux variables sont identiques.

// -- L'Opérateur de Comparaison "===" signifie : strictement égal à ...
// Il va comparer la valeur et aussi le type de données.

// -- L'Opérateur de Comparaison "!=" signifie : différent de ...

// -- L'Opérateur de Comparaison "!==" signifie : strictement différent de ...

/* ------------------------
    EXERCICE:
    J'arrive sur un espace sécurisé au moyen d'un email et d'un mot de passe.
    Je doit saisir mon email et mon mot de passe afin d'être authentifié sur le site.
    En cas d'échec une alert m'informe du problème.
    Si tous se passe bien, un message de bienvenue m'accueil.
------------------------- */

// -- BASE DE DONNEES
var email, mdp;

email = "wf3@hl-media.fr";
mdp = "wf3";

// 1 -- Demander son email à l'utilisateur avec un prompt
var emailLogin = prompt("Adresse Email", "exemple@gogle.fr");

// 2 -- Je vérifie si l'email saisie (emailLogin) correspond à celui en Base de Donnée
if(emailLogin === email) {
    // 2a. Si tout est ok, je continu la vérification avec le mot de passe
    // 2a1. Je demande à mon utilisateur son mot de passe
    var mdpLogin = prompt("Mot de Passe", "xxxxx");

    if(mdpLogin === mdp) {
        alert("Bienvenu sur mon site !");
    } else {
        // 2a2. Sinon, les mots de passe ne correspondent pas, je lance une Alert...
        alert("Le mot de passe saisi n'est pas valide !")
    }
} else {
    // 2b. Sinon, les emails ne correspondent pas, je lance une Alert...
    alert("L'email saisi n'est pas valide !")
}

/* -----------------------------------
      LES OPERATEURS DE LOGIQUES
----------------------------------- */

// L'opérateur ET : && ou AND

if( (emailLogin === email) && (mdpLogin === mdp) ) { ... } // Ici les deux doivent correspondre

// L'opérateur ou : || ou OR

if( (emailLogin === email) || (mdpLogin === mdp) ) { ... } // Ici soit l'un soit l'autre doit correspondre

// -- L'Opérateur "!" : qui signifie le CONTRAIRE de, ou encore NOT

var siMonUtilisateurEstApprouve = true;
if(!siMonUtilisateurEstApprouve) {...} // Si l'utilisateur n'est pas approuvé.