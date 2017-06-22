<style>
    * { font-family: calibri;}
    h1{ padding: 10px; color: white; background-color: darkslategrey;}
</style>
<h1>Ecriture et affichage</h1>
<!-- Tout d'abord, il est possible d'écrire du HTML dans un fichier .php, en revanche l'inverse n'est pas possible -->
<?php // balise php ouverture et fermeture ?>
<?php
// Instruction d'affichage
// Variable : type / déclaration / affectation
// Concaténation
// Guillemets et quotes
// Constante
// Condition et opérateurs de comparaison
// Fonction prédéfinie
// Fonction utilisateur
// Boucle
// Inclusion
// Array (tableau)
// Classes et Objets

echo 'Bonjour'; // echo est une instruction permettant d'effectuer un affichage
echo '<br />'; // il est possible de mettre du HTML
echo 'Bienvenue <br />'; // si vous regardez le code source, il n'est pas possible de voir le code php car déjà interprété depuis le serveur
print 'Print est une autre instruction d\'affichage similaire à echo<br />';

// Les commentaires en PHP
// Ceci est un commentaire sur une seule ligne
# Ceci est un commentaire sur une seule ligne

/* 
Ceci est un commentaire
sur plusieurs
lignes
 */

 // Autre instruction d'affichage mais spécifique aux phases de développement: print_r() & var_dump()

 echo '<h1>Variables: types / déclaration / affectation</h1>';
 // définition: une variable est un espace nommé permettant de conserver une valeur.

 // Déclaration d'une variable avec le signe $ // une variable est sensible à la casse
 // caractères autorisées: de a à z, 0 à 9 et le _ // /!\ une variable ne peut pas commencer par un chiffre.

 // Affectation d'une variable avec =
 $a = 127;
 echo gettype($a);
 echo '<br />';

 $b = 1.5;
 echo gettype($b);
 echo '<br />';

 $a = 'Une chaine';
 echo gettype($a);
 echo '<br />';

 $b = '127';
 echo gettype($b);
 echo '<br />';

$a = true; // ou TRUE // ou l'inverse false/FALSE
echo gettype($a); // boolean
echo '<br />';

echo '<h1>Concaténation</h1>';
// en php nous utiliserons le . pour la concaténation que l'on peut traduire par "suivi de"
$x = 'Bonjour';
$y = 'tout le monde';
echo $x . ' ' . $y . '<br />';

echo '<br />', 'Coucou', '<br />'; // il est possible de faire la concaténation avec une , en revanche uniquement avec echo. (erreur avec print)

echo '<h1>Concaténation lors de l\'affectation</h1>';
$prenom1 = 'Bruno';
$prenom1 = 'Claire';

echo $prenom1, '<br />'; // affiche Claire

$prenom2 = 'Bruno ';
$prenom2 .= 'Claire'; // équivalent à écrire $prenom2 = $prenom2 . 'Claire';
// le .= permet de rajouter à l'existant sans l'écraser.
echo $prenom2 . '<br />';

echo '<h1>Guillemets et Quotes</h1>';

$message = "Aujourd'hui";
// ou
$message = 'Aujourd\'hui';

// concaténation:
echo $message . ' il fait chaud <br />';
echo "$message il fait chaud<br />"; // dans des guillemets, les variables sont reconnues et donc interprétés.
echo '$message il fait chaud<br />'; // dans des quotes, les variables ne sont pas reconnues et donc interprétées comme du texte.

echo '<h1>Les Constantes & Constantes magiques</h1>';
// une constante est un peu comme une variable, un espace nomé nous permettant de conserver une valeur sauf que comme son nom l'indique, cette valeur ne pourra pas changer durant l'éxecution du script.
define('CAPITALE', 'Paris'); // 1er argument: le nom de la constante / 2eme argument: sa valeur
// Par convention, une constante s'écrit toujours en majuscule.
echo CAPITALE . '<br />';

// constante magique
echo __FILE__ . '<br />'; // affiche le chemin complet jusqu'à ce fichier
echo __LINE__ . '<br />'; // affiche le numéro de la ligne

echo '<h1>Exercice sur les variables</h1>';
// mettre les valeurs 'lundi', 'mardi', 'mercredi' dans 3 variables.
// afficher 'lundi - mardi - mercredi' en appelant les variables.
$lundi = 'lundi';
$mardi = 'mardi';
$mercredi = 'mercredi';
$sep = ' - ';

echo $lundi . " - " . $mardi . " - " . $mercredi . "<br />";
echo $lundi . $sep . $mardi . $sep . $mercredi . "<br />";
echo "$lundi - $mardi - $mercredi<br />";

echo '<h1>Opérateurs arithmétiques</h1>';
$a = 10; $b = 2;
echo $a + $b . '<br />'; // affiche 12
echo $a - $b . '<br />'; // affiche 8
echo $a * $b . '<br />'; // affiche 20
echo $a / $b . '<br />'; // affiche 5
echo $a % $b . '<br />'; // modulo -> affiche 0 (le reste de la division)

// facilité d'écriture:
echo $a += $b . '<br/>'; // équivaut à $a = $a + $b
// $a -= $b
// $a *= $b
// $a /= $b

echo '<h1>Structure conditionnelles (if / else if / else) et opérateurs de comparaison</h1>';

// isset - empty
// isset test si l'élément existe (s'il a été déclaré au préalable dans notre script par exemple)
// empty test si l'élément est vide (à savoir, empty vérifie au préalable si l'élément est défini avant de tester s'il est vide)

$var1 = 0; // ou $var1 = ''; $var1 = false;

if(empty($var1))
{
    echo 'la valeur var1 est vide ou non définie<br />';
}

$var2 = "";
if(isset($var2))
{
    echo "la variable var2 existe !<br />";
}

// opérateurs de comparaison
$a = 10; $b = 5; $c = 2;

if($a > $b) // si 'a' est strictement supérieur à 'b'
{
    print "'a' est bien supérieur à 'b'<br />";
}
else { // sinon -> toutes les autres possibilités
    print "'a' n'est pas supérieur à 'b'<br />";
}

// ET
if($a > $b && $b > $c) // si 'a' est supérieur à 'b' ET DANS LE MÊME TEMPS si 'b' est supérieur à 'c'
{
    echo 'Ok pour les deux conditions<br />';
}

// OU
if($a == 9 || $b > $c) // si 'a' est égal à 9 OU si 'b' est supérieur à 'c'
{
    echo 'Ok pour au moins une des deux conditions<br />';
}

// XOR (condition exclusive)
if($a == 10 XOR $b < $c) // avec XOR on ne rentre dans la condition que si l'une des deux conditions est vrai. Si les deux sont vrais on ne rentre pas
{
    echo 'Ok pour une seule des deux conditions<br />';
}
/* Avec XOR :
    true XOR true => false
    false XOR false => false
    true XOR false => true
    false XOR true => true
*/

if($a == 8)
{
    print 'réponse 1<br />';
}
elseif($a != 10)
{
    print 'réponse 2<br />';
}
else{
    echo 'réponse 3<br />';
}

$a1 = 1;
$a2 = '1';

if($a1 == $a2)
{
    echo 'C\'est la même chose<br />';
}
/*
    =   Affectation
    ==  Comparaison des valeurs
    === Comparaison des valeurs ET du types
    !=  Différent de (en terme de valeur)
    !== Diféérent de (en terme de valeur ou de type)
    >   Strictement supérieur
    <   Strictement inférieur
    >=  Supérieur ou égal
    <=  Inférieur ou égale
*/

// forme contractée des if: autre écriture
echo ($a == 10) ? 'if en forme contractée' : 'else en forme contractée<br />';
// le ? représente le if et les : représentent le else

echo '<h1>Condition switch</h1>';
// les cases représentent des cas différents dans lesquels nous pouvons potentiellement rentrer.
$couleur = 'jaune';
switch($couleur)
{
    case 'bleu':
        echo 'Vous aimez le bleu<br />';
    break;
    case 'rouge':
        echo 'Vous aimez le rouge<br />';
    break;
    case 'vert':
        echo 'Vous aimez le vert<br />';
    break;
    default: // toutes les autres possibilités
        echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br />';
    break;
}

// EXERCICE: Refaire la condition précédente avec if / elseif / else
if($couleur == 'bleu')
{
    echo 'Vous aimez le bleu<br />';
}
elseif($couleur == 'rouge')
{
    echo 'Vous aimez le rouge<br />';
}
elseif($couleur == 'vert')
{
    echo 'Vous aimez le vert<br />';
} else {
    echo 'Vous n\'aimez ni le bleu, ni le rouge, ni le vert<br />';
}

echo '<h1>Fonctions prédéfinies</h1>';
// Une fonction prédéfinie est déjà inscrite dans le langage, le développeur ne fait que l'éxecuter
echo 'Date du jour:<br />';
echo date('d/m/Y H:i:s');
// date est une fonction prédéfinie permettant d'afficher la date
// en argument cette fonction accepte une chaîne de caractère.
// Selon les caractères fournis, cette fonction nous renvoie différent format de date
// voir la doc pour les formats disponibles: http://php.net//manual/fr/function.date.php
echo '<hr />' . time() . '<hr />'; // time() nous affiche le timestamp (nb de seconde écoulées deouis le 1er janvier 1970)

// traitement des chaînes (iconv_strlen() / strpos() / substr())
$email = 'mathieuquittard@evogue.fr';
echo strpos($email, '@') . '<br />';
// strpos permet de chercher dans une chaîne (fournie en 1er argument) une autre chaîne (fournie en 2ème argument)
// /!\ dans une chaîne le 1er caractère a la position 0

// valeur de retour
    // Succes => on obtient un Int (la position)
    // Echec => booleen 'false'

$email2 = "cenestpasunmail";
echo strpos($email2, '@') . '<br />';
var_dump(strpos($email2, '@')); // var_dump() est une instruction d'affichage améliorée nous affichant la valeur de ce que l'on teste + son type et si le type est string on obtient également sa longueur
// ici var_dump() nous permet de voir le false obtenu via la fonction strpos()

// iconv_strlen()
$phrase = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.';
echo '<br />';
echo iconv_strlen($phrase) . '<br />';
// iconv_strlen permet de compter le nombre de caractère dans une chaîne
    // Succes => Int (longueur de la chaîne)

// substr
$texte = 'Etiam interdum tristique bibendum. Integer vel diam consequat, vehicula felis ac, suscipit velit. Sed tincidunt in est at hendrerit. Mauris lacinia, tellus eget placerat viverra, purus velit vehicula eros, id auctor est enim ut nulla. Nunc pharetra non dolor quis facilisis. Nam aliquet viverra dui quis consequat. In at volutpat purus, quis viverra augue.';
echo substr($texte, 0, 35) . "... <a href='#'>Lire la suite</a>";
// substr permet de découper une chaîne
    // 1er argument => la chaîne à découper
    // 2eme argument => la position de départ
    // 3eme argument => le nombre de caractères à renvoyer (cet argument est facultatif, s'il n'est pas présent on récupère tout depuis la position de départ)

echo '<h1>Fonctions utilisateur</h1>';
// non inscrite au langage, c'est le développeur qui les déclare puis les éxecute

function separation()
{
    echo '<hr /><hr /><hr />';
}
// execution:
separation();

// fonction avec un argument
function bonjour($qui)
{
    return "Bonjour " . $qui . "<br />";
}
// un return nous renvoi le resultat de cette fonction en revanche si l'on veut faire un affichage il faudra passer par un echo
echo bonjour('Mathieu');
$prenom = 'Marie';
echo bonjour($prenom);

// fonction pour appliquer la TVA
function appliqueTVA($nombre)
{
    return $nombre * 1.2;
}
echo appliqueTVA(1000) . '<br />';

// EXERCICE: refaire la fonction précédente en donnant la possibilité à l'utilisateur de choisir le taux (que ce ne soit pas figé sur le taux 1.2)
function appliqueTVA2($nombre, $taux)
{
    return $nombre * $taux;
}
echo appliqueTVA2(500, 1.5) . '<br />';

// avec l'argument $taux initialisé par défaut:
function appliqueTVA3($nombre, $taux = 1.2)
{
    return $nombre * $taux;
}
echo appliqueTVA3(500) . '<br />'; // avec un argument initialisé par défaut, il devient facultatif. Si je ne fournis qu'un seul argument, alors $taux a par défaut la valeur 1.2
echo appliqueTVA3(500, 1.6) . '<br />';

// Evironnement Global et Local
// Global => le script complet
// Local => à l'intérieur d'une fonction

function jour_semaine()
{
    $jour = 'lundi';
    return $jour;
}
// echo $jour; // $jour n'est pas défini dans l'espace global => erreur
echo jour_semaine() . '<br />';
$jour2 = jour_semaine();
echo $jour2 . '<br />';

// Global vers Local:
$pays = 'France';

affichage_pays(); // il est possible d'éxecuter une fonction avant sa déclaration car l'interpréteur php charge toutes les fonctions du script avant de l'éxecuter

function   affichage_pays()
{
    global $pays; // grâce au mot clé global, il est possible de récupérer une variable depuis l'espace global sinon ce n'est pas possible car nous sommes dans un espace local (dans une fonction)
    echo 'Le pays est: ' . $pays . '<br />';
}

// affichage météo
function affichage_meteo($saison, $temperature)
{
    return 'Nous sommes en ' . $saison . ' et il fait ' . $temperature . ' degré(s).<br />';
    echo 'Nous sommes mardi<br />'; // le return fait sortir de la fonction, du coup cette instruction ne sera pas éxecutée.
}

echo affichage_meteo('été', 27);
echo affichage_meteo('hiver', -1);
echo affichage_meteo('printemps', 18);
echo '<br />';

// affichage météo 2 (avec 'au' à la place de 'en' pour printemps et affichage du s ou non selon la température)
function affichage_meteo2($saison, $temperature)
{
    if(($saison == 'printemps') && (-1 <= $temperature && $temperature <= 1)) {
        return 'Nous sommes au ' . $saison . ' et il fait ' . $temperature . ' degré.<br />';
    } 
    if(($saison == 'printemps') && (-1 > $temperature || $temperature > 1)) {
        return 'Nous sommes au ' . $saison . ' et il fait ' . $temperature . ' degrés.<br />';
    } 
    if(-1 <= $temperature && $temperature <= 1){
        return 'Nous sommes en ' . $saison . ' et il fait ' . $temperature . ' degré.<br />';
    } 
    return 'Nous sommes en ' . $saison . ' et il fait ' . $temperature . ' degrés.<br />';
}

echo affichage_meteo2('été', 27);
echo affichage_meteo2('hiver', -1);
echo affichage_meteo2('printemps', 18);
echo affichage_meteo2('printemps', 0);
echo '<br />';

// OU AVEC VARIABLES (moins de lignes de codes et plus lisibles)
function meteo($saison, $temperature)
{
    $en = 'en';
    $s = 's';

    if($saison == 'printemps'){
        $en = 'au';
    }
    if(-1 <= $temperature && $temperature <= 1){
        $s = '';
    } 
    return 'Nous sommes ' . $en . ' ' . $saison . ' et il fait ' . $temperature . ' degré' . $s . '<br />';
}

echo meteo('été', 27);
echo meteo('hiver', -1);
echo meteo('printemps', 18);
echo meteo('printemps', 1);
echo '<br />';


echo '<h1>Structure itérative: les boucles</h1>';

// boucle WHILE
$i = 0; // valeur de départ
while($i <= 10) // condition d'entrée
{
    echo $i . ' - ';
    $i++; // incrémentation ou décrémentation ($i--) / équivaut à écrire $i = $i + 1
}
echo '<br />';

 // EXERCICE: refaire une boucle similaire en enlevant le dernier - affiché après la valeur 10
$j = 0;
while($j <= 10)
{
    if($j < 10){
        echo $j . ' - ';
    } else {
        echo $j;
    }       
    $j++;
}
echo '<br />';

 // boucle FOR
 // for (valeur_de_depart; condition_dentree; incrementation)
 for($i=0; $i<9; $i++)
 {
     echo $i;
 }

 // EXERCICE: afficher en utilisant While ou For un tableau HTML contenant 10 cellules
 ?>
 <table style='border-collapse: collapse;' border='1'>
    <tr>
        <td>0</td>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
    </tr>
 </table>
  <?php
  // pour aller plus loin faire un tableau allant de 0 à 99 format 10x10.
echo '<br />';

// tableau de 0 à 9

echo "<table style='border-collapse: collapse;' border='1'><tr>";
    for($j=0; $j<10; $j++)
                {  
                    echo '<td>' . $j . '</td>';
                }
echo '</tr></table><br />';

// tableau de 0 à 99

// AVEC OPERATION NUMERIQUE
echo "<table style='border-collapse: collapse; color: red'; border='1'>";
for($y=0; $y<10; $y++){ 
    echo '<tr>';   
    for($j=0; $j<10; $j++)
                {  
                    echo '<td>' . ($j + ($y*10)) . '</td>';
                }
    echo '</tr>';
}
echo '</table><br />';

// AVEC UNE TROISIEME VARIABLE
echo "<table style='border-collapse: collapse; color: green'; border='1'>";
$x = 0;
for($y=0; $y<10; $y++){ 
    echo '<tr>';   
    for($j=0; $j<10; $j++)
                {  
                    echo '<td>' . $x . '</td>';
                    $x++;
                }
    echo '</tr>';
}
echo '</table><br />';

// AVEC CONCATENATION
echo "<table style='border-collapse: collapse; color: blue'; border='1'>";
for($y=0; $y<10; $y++){ 
    echo '<tr>';   
    for($j=0; $j<10; $j++)
                {  
                    echo '<td>' . $y . $j . '</td>';
                }
    echo '</tr>';
}
echo '</table><br />';

echo '<h1>Inclusion de fichiers</h1>';
// créer un fichier dans le même dossier que celui-ci: exemple.inc.php
// dans ce fichier mettez du texte (lorem ipsum, html, ...)

echo '<b>Première fois avec include:</b><br />';
include('exemple.inc.php');

echo '<br /><b>Deuxième fois avec include:</b><br />';
include_once('exemple.inc.php'); // le fichier est déjà présent donc il ne l'affiche pas

echo '<br /><b>Première fois avec require:</b><br />';
require('exemple.inc.php');

echo '<br /><b>Deuxième fois avec require:</b><br />';
require_once('exemple.inc.php');

/*
Différences entre include et require:
En cas d'erreur comme par exemple une faute de frappe sur le nom du fichier ou le fichier a été déplacé, etc...
- Include provoque une erreur MAIS continue l'éxecution du script.
- Require provoque une erreur ET bloque l'éxecution la suite du script
*/

echo '<h1>Les Tableaux ARRAY</h1>';
// un tableau array est déclaré un peu comme une variable sauf qu'au lieu de ne conserver qu'une seule et unique valeur, dans un tableau nous allons avoir un ensemble de valeurs.

// déclaration d'un tableau
$tableau = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');

// outil pour pouvoir voir le contenu du tableau
echo '<b>Affichage du tableau avec print_r</b>';
echo '<pre>'; print_r($tableau); echo '</pre>';

echo '<b>Affichage du tableau avec var_dump</b>';
echo '<pre>'; var_dump($tableau); echo '</pre>';

// autre façon de déclarer un tableau array
$tab[] = 'FRANCE';
$tab[] = 'ITALIE';
$tab[] = 'ESPAGNE';
$tab[] = 'ANGLETERRE';
$tab[] = 'PORTUGAL';
$tab[] = 'BELGIQUE';

// EXERCICE: afficher le contenu du tableau avec un print_r ou un var_dump puis essayer de sortir la valeur ESPAGNE avec un echo en passant par le tableau

echo '<pre>'; var_dump($tab); echo '</pre>';
echo $tab[2].'<br /><hr />'; // pour extraire un élément du tableau array, on appelle l'indice correspondant.
// dans le doute faire un var_dump ou print_r pour vérification

// Boucle foreach pour les tableaux de données ARRAY ou Object
foreach($tab AS $valeur)
{
    // foreach est un outil pour faire une boucle spécifique aux tableaux array & object.
    // cette boucle est dynamique et tournera autant de fois qu'il y a d'éléments dans notre tableau ou objet.
    // le mot clé AS est obligatoire et permet de donner un alias via une variable qui représentera à chaque tour de boucle la valeur en cours.
    echo $valeur . '<br />';
}

echo '<hr />';
// pour récupérer également l'indice en cours, il nous suffit de rajouter une variable de réception après le mot clé AS:
foreach($tab AS $ind => $val)
{
    echo $ind . ' - ' . $val . '<br />';
}

// il est possible de choisir nous même les indices
$plats = array( 'un' => 'Pâtes', 'deux' => 'Crêpes', 'trois' => 'Salade de fruits', 77 => 'Eau');
echo '<pre>'; var_dump($plats); echo '</pre>';

$couleur = array();
$couleur['j']   = 'jaune';
$couleur['b']   = 'bleu';
$couleur['v']   = 'vert';
$couleur['r']   = 'rouge';
$couleur['bl']  = 'blanc';
echo '<pre>'; var_dump($couleur); echo '</pre>';
echo $couleur['b'] . '<br />';

// Pour connaître la taille d'un tableau (combien d'éléments dans le tableau array)
echo 'Taille du tableau couleur: ' . count($couleur);
echo 'Taille du tableau couleur: ' . sizeof($couleur);

echo '<h1>Tableaux Array multidimensionnels</h1>';
// nous parlons de tableaux array multidimensionnels lorsqu'un tableau est lui même contenu dans un autre tableau.

$tableau_etudiant = array(0 => array('pseudo' => 'Marie', 'nom' => 'Durand', 'email' => 'marie@email.fr'), 1 => array('pseudo' => 'Luc', 'nom' => 'Dupond', 'email' => 'luc@email.fr'), 3 => array('pseudo' => 'Jean', 'nom' => 'Imbert', 'email' => 'jean@email.fr'));

$tableau_etudiant = array(
                        0 => array(
                            'pseudo' => 'Marie',
                            'nom' => 'Durand',
                            'email' => 'marie@email.fr'),
                        1 => array(
                            'pseudo' => 'Luc',
                            'nom' => 'Dupond',
                            'email' => 'luc@email.fr'), 
                        2 => array(
                            'pseudo' => 'Jean',
                            'nom' => 'Imbert', 
                            'email' => 'jean@email.fr'),
                        );

echo '<pre>'; print_r($tableau_etudiant); echo '</pre>';

echo $tableau_etudiant[1]['email'] . '<br />'; // nous rentrons d'abord à l'indice 1 du premier niveau puis à l'indice 'email' du deuxième niveau

$tableau_etudiant_lenght = sizeof($tableau_etudiant);

for($i=0; $i<$tableau_etudiant_lenght; $i++)
{
    // afficher les emails du deuxième niveau
    echo $tableau_etudiant[$i]['email'] . '<br />';
}

echo '<hr />';

// avec un foreach
foreach($tableau_etudiant AS $valeur)
{
    echo $valeur['email'] . '<br />';
}
echo '<hr />';
// double foreach pour afficher toutes les informations
foreach($tableau_etudiant AS $valeur)
{
    foreach($valeur AS $val)
    {
        echo $val . '<br />';
    }
    echo '<hr />';
}


echo '<h1>Les Objets</h1>';
// un objet est un autre type de données. Un peu à la manière d'un array, il permet de conserver des valeurs mais cela va plus loin puisqu'on peut également avoir des fonctions dans un objet.
// une information dans un objet s'appelle une propriété ou attribut
// une fonction dans un objet s'appelle une méthode

// un objet est toujours issu d'une classe (son modèle de construction)

// pour déclarer une classe
class Etudiant
{
    public $prenom = 'Marie';
    // public est un mot clé permettant de préciser que l'élément sera accessible directement sur l'objet. Sinon il faudrait passer par des méthodes permettant de récupérer cette information ou de la modifier (il existe aussi protected / private / static).
    
}