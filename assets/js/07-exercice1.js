/* --
    Votre mission, que vous devez accepter !
    Réaliser une fonction permettant à un internaute de :
        - Saisir son Prénom dans un Prompt
        - Retourner à l'utilisateur : Bonjour [PRENOM], Quel age as-tu ?
        - Saisir son Age
        - Retourner à l'utilisateur : Tu es donc né en [ANNEE DE NAISSANCE]
        - Afficher ensuite un récapitulatif dans la page.
        Bonjour [PRENOM], tu as [AGE] !
-- */

// 1 -- Initialisation des variables
var AnneeActuelle = new Date();

// 2 -- Création de la fonction
function Hello() {

    // 2a. -- Je demande à l'utilisateur son Prénom
    let prenom = prompt("Entrez votre Prenom", "Prenom");

    // 2b. -- Je lui demande son âge
    let age = parseInt(prompt("Bonjour " + prenom + ", quel âge as-tu ?", "Age"));
    
    // 2c. -- J'affiche une alert avec son année de naissance !
    alert("Tu es donc né en " + (AnneeActuelle.getFullYear() - age));

    // 2d. -- Affichage dans ma page HTML
    document.write("Bonjour " + prenom + ", tu as " + age + " ans !");
}
// 3 Execution de ma fonction
Hello();