/* -----------------------
      LES BOUCLES
----------------------- */

// -- La Boucle FOR

// -- Pour i = 1 ; tant que i <= (inférieur ou égale à) 10 ; alors, j'incrémente. 
for(var i = 1; i <= 10; i++){
    document.write("<p>Instruction executée : <strong>" + i + "</strong></p>");
}

document.write("<hr>");

// -- La Boucle WHILE : Tant que

var j = 1;
while(j <= 10){
    document.write("<p>Instruction executée : <strong>" + j + "</strong></p>");
    j++; // -- On incrémente pour éviter de se retrouver dans une boucle infinie
}

document.write("<hr>");

/* ------------------------
    EXERCICE:
------------------------- */

// -- Supposons, le tableau suivant :
var Prenoms = ["Hugo", "Jean", "Matthieu", "Luc", "Pierre", "Marc"];

/* CONSIGNE : Grâce à une boucle FOR, afficher la liste des prénoms du tableau
suivant dans la console ou sur votre page. */
var NbElementsTableau = Prenoms.length;

for(var i= 0; i < NbElementsTableau; i++)
{
     document.write(Prenoms[i]);
}

document.write("<hr>");