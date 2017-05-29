 /* I. Créer un Tableau 3D "PremierTrimestre" contenant la moyenne d'un étudiant pour plusieurs matières.

    Nous auront donc pour un étudiant, sa moyenne à plusieurs matières.
    
    Par exemple : Hugo LIEGEARD : [ Francais : 12, Math : 19, Physique 4], ... etc
    
    **** Vous allez créez au minimum 5 étudiants ****

II. Afficher sur la page (à l'aide de document.write) pour chaque étudiant, la liste (ul et li) de sa moyenne à chaque matière, puis sa moyenne générale. */

var Noms = ["Clark KENT", "Barry ALLEN", "Hal JORDAN", "Diana PRINCE", "Bruce WAYNE"]
var Francais    = [14, 14, 12, 15, 20];
var Maths       = [12, 18, 15, 15, 20];
var EPS         = [18, 16, 14, 18, 20];
var ClarkKent   = [Francais[0], Maths[0], EPS[0]];
var BarryAllen  = [Francais[1], Maths[1], EPS[1]];
var HalJordan   = [Francais[2], Maths[2], EPS[2]];
var DianaPrince = [Francais[3], Maths[3], EPS[3]];
var BruceWayne  = [Francais[4], Maths[4], EPS[4]];

var PremierTrimestre = [ClarkKent, BarryAllen, HalJordan, DianaPrince, BruceWayne];
console.log(PremierTrimestre);

function MoyenneCK()
{
        let n = ClarkKent.length;
        let somme = 0;
        for(i=0; i<n; i++)
                somme += ClarkKent[i];
        return Math.round(somme/n);
};
function MoyenneBA()
{
        let n = BarryAllen.length;
        let somme = 0;
        for(i=0; i<n; i++)
                somme += BarryAllen[i];
        return Math.round(somme/n);
};
function MoyenneHJ()
{
        let n = HalJordan.length;
        let somme = 0;
        for(i=0; i<n; i++)
                somme += HalJordan[i];
        return Math.round(somme/n);
};
function MoyenneDP()
{
        let n = DianaPrince.length;
        let somme = 0;
        for(i=0; i<n; i++)
                somme += DianaPrince[i];
        return Math.round(somme/n);
};
function MoyenneBW()
{
        let n = BruceWayne.length;
        let somme = 0;
        for(i=0; i<n; i++)
                somme += BruceWayne[i];
        return Math.round(somme/n);
};


document.write(
    "<ol><li> " + Noms[0] + "<ul><li> Français : " + ClarkKent[0] + "</li>" + "<li> Maths : " + ClarkKent[1] + "</li>" + "<li> EPS : " + ClarkKent[2] + "</li>" + "<li><strong>Moyenne Générale</strong> : " + MoyenneCK() + "</li></ul><br>" +
    "<li> " + Noms[1] + "<ul><li> Français : " + BarryAllen[0] + "</li>" + "<li> Maths : " + BarryAllen[1] + "</li>" + "<li> EPS : " + BarryAllen[2] + "</li>" + "<li><strong>Moyenne Générale</strong> : " + MoyenneBA() + "</li></ul><br>" +
    "<li> " + Noms[2] + "<ul><li> Français : " + HalJordan[0] + "</li>" + "<li> Maths : " + HalJordan[1] + "</li>" + "<li> EPS : " + HalJordan[2] + "</li>" + "<li><strong>Moyenne Générale</strong> : " + MoyenneHJ() + "</li></ul><br>" +
    "<li> " + Noms[3] + "<ul><li> Français : " + DianaPrince[0] + "</li>" + "<li> Maths : " + DianaPrince[1] + "</li>" + "<li> EPS : " + DianaPrince[2] + "</li>" + "<li><strong>Moyenne Générale</strong> : " + MoyenneDP() + "</li></ul><br>" +
    "<li> " + Noms[4] + "<ul><li> Français : " + BruceWayne[0] + "</li>" + "<li> Maths : " + BruceWayne[1] + "</li>" + "<li> EPS : " + BruceWayne[2] + "</li>" + "<li><strong>Moyenne Générale</strong> : " + MoyenneBW() + "</li></ul></li></ol>"
);