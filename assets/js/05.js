/* ------------------------------------------
      INCREMENTATIONS ET DECREMENTATIONS
------------------------------------------ */

// ########### Incrémentation ########### //

var nb1 =   1;
nb1 = nb1 + 1;

// -- Affichage dans la console
console.log(nb1);

// -- Ecriture Simplifié
nb1++; // -- "++" Incrémente toujours de 1 -> nb1 = nb1 + 1;

// -- Affichage dans la console
console.log(nb1);

// ########### Décrémentation ########### //

nb1 = nb1 - 1;

// -- Affichage dans la console
console.log(nb1);

// -- Ecriture Simplifié
nb1--; // -- "--" Décrémente toujours de 1 -> nb1 = nb1 - 1;

// -- Affichage dans la console
console.log(nb1);

// ########### Subtilité ########### //

nb1 = 1;
console.log(nb1++); // -- Affiche nb1 avant incrémentation

nb1 = 1;
console.log(++nb1); // -- Affiche nb1 après incrémentation