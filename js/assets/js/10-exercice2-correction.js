 /* I. Créer un Tableau 3D "PremierTrimestre" contenant la moyenne d'un étudiant pour plusieurs matières.

    Nous auront donc pour un étudiant, sa moyenne à plusieurs matières.
    
    Par exemple : Hugo LIEGEARD : [ Francais : 12, Math : 19, Physique 4], ... etc
    
    **** Vous allez créez au minimum 5 étudiants ****

II. Afficher sur la page (à l'aide de document.write) pour chaque étudiant, la liste (ul et li) de sa moyenne à chaque matière, puis sa moyenne générale. */

/* ************    CORRECTION    *************** */


// -- Petite fonction de raccourci (lesflemmards.js)

function w(t) {
    document.write(t);
};

function l(e) {
    console.log(e);
};

// -- 1. Création de notre tableau 3D en JS !

var PremierTrimestre = [
    {
        "nom"   :   "KENT",
        "prenom":   "Clark",
        "notes" :   {
                        "francais"  :   14,
                        "maths"     :   12,
                        "eps"       :   18,
                    }
    },
    {
        "nom"   :   "ALLEN",
        "prenom":   "Barry",
        "notes" :   {
                        "francais"  :   14,
                        "maths"     :   18,
                        "eps"       :   16,
                    }
    },
    {
        "nom"   :   "JORDAN",
        "prenom":   "Hal",
        "notes" :   {
                        "francais"  :   12,
                        "maths"     :   15,
                        "eps"       :   14,
                    }
    },
    {
        "nom"   :   "PRINCE",
        "prenom":   "Diana",
        "notes" :   {
                        "francais"  :   15,
                        "maths"     :   15,
                        "eps"       :   18,
                        "grec"      :   20,
                    }
    },
    {
        "nom"   :   "WAYNE",
        "prenom":   "Bruce",
        "notes" :   {
                        "francais"  :   20,
                        "maths"     :   20,
                        "eps"       :   20,
                    }
    },
];

l(PremierTrimestre);

w("<ol>");
// -- Je souhaite afficher la liste de mes étudiants.
for(i=0; i<PremierTrimestre.length; i++) {
    // -- On récupère l'Objet Etudiant de l'itération.
    let Etudiant = PremierTrimestre[i];

    // -- Aperçu dans la console
    l(Etudiant);

    // -- Je définis NombreDeMatiere et la SommeDesNotes à 0
    var NombreDeMatiere = 0, SommeDesNotes = 0;

    // -- Afficher le Prénom et le Nom d'un Etudiant
    w("<li>");
        w(Etudiant.prenom + " " + PremierTrimestre[i].nom);

        // -- Afficher les notes des étudiants.
        w("<ul>");
            for(let matiere in Etudiant.notes){
                // l(matiere);
                // l(Etudiant.notes[matiere]);
                NombreDeMatiere++;
                SommeDesNotes += Etudiant.notes[matiere];

                w("<li>");
                    w(matiere + " : " + Etudiant.notes[matiere]);
                w("</li>");
            }; // -- Fin de la boucle matiere

            w("<li>");
                w("<strong>Moyenne Générale : </strong>" + Math.round(SommeDesNotes/NombreDeMatiere));
            w("</li>");
        w("</ul><br>");
    w("</li>");
}; // -- Fin de la boucle Etudiant
w("</ol>");