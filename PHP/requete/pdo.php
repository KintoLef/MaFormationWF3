<?php
/*
// ----------------------------------------------------------------------
// PDO -> Php Data Object

// EXEC()
    INSERT, UPDATE, DELETE: EXEC() est une méthode de l'objet pdo qui est utilisée pour la formulmation de requete ne retournant pas de résultat.
    Valeur de retour:
    -----------------
    succes => on obtient un entier (int) correspondant au nombre de lignes affectées.
    echec => on obtient le booleen false

// QUERY()
    INSERT, UPDATE, DELETE, SELECT, SHOW, ...: Query() est utilisé pour tout type de requête.
    Valeur de retour:
    -----------------
    succes => on obtient un nouvel objet issue de la class PDOStatement
    echec => on obtient le booleen false

// PREPARE() + EXECUTE()
    INSERT, UPDATE, DELETE, SELECT, SHOW, ...: prepare() permet de préparer la requête mais ne l'éxecute pas; execute() éxecute la requête
    Valeur de retour:
    -----------------
    succes => on obtient un nouvel objet issue de la classe PDOStatement
    echec => on obtient le booleen false

    // les requêtes préparées sont à préconiser pour sécuriser les données
    // cela permet également d'éviter le cycle complet d'une requête:
        analyse / interprétation / éxecution

*/

// 1. Connexion à une BDD
$pdo = new PDO('mysql:host=localhost;dbname=wf3_entreprise', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
// arguments: 1- (serveur+nom_bdd), 2- identifiant, 3- mot de passe, 4- options

// echo '<pre>'; var_dump($pdo); echo '</pre>'; 
// echo '<pre>'; var_dump(get_class_methods($pdo)); echo '</pre>'; 

// 2. PDO: EXEC()
// insert
$resultat = $pdo -> exec("INSERT INTO employes (prenom, nom, sexe, service, salaire, date_embauche) VALUES ('Quentin', 'Lefevre', 'm', 'informatique', 3000, '2017-06-22')");
echo 'nombre de lignes insérées par la dernière requête: ' . $resultat;

// pour récupérer le dernier id inséré:
// echo $pdo->lastInsertId();

// 3. PDO: QUERY => SELECT + FETCH (pour un seul résultat)
$resultat = $pdo -> query("SELECT * FROM employes WHERE id_employes=350");
echo '<pre>'; var_dump($resultat); echo '</pre>';
// echo '<pre>'; var_dump(get_class_methods($resultat)); echo '</pre>';

// en l'etat, $resultat est inexploitable. Nous devons le traiter avec la methode FETCH afin de rendre les informations exploitables.
$info_employe = $resultat -> fetch(PDO::FETCH_ASSOC); // FETCH_ASSOC pour un tableau array associatif (le nom des colonnes comme indice du tableau)

// $info_employe = $resultat -> fetch(PDO::FETCH_NUM); // FETCH_NUM pour un tableau indexé numériquement

// $info_employe = $resultat -> fetch(); // => FETCH_BOTH (par défaut), est un mélange de FETCH_ASSOC et FETCH_NUM

// $info_employe = $resultat -> fetch(PDO::FETCH_OBJ); // FETCH_OBJ pour obtenir un objet avec les éléments disponibles en propriétés publiques

echo '<pre>'; print_r($info_employe); echo '</pre>';

echo $info_employe['prenom'] . '<hr />'; // avec FETCH_ASSOC
// echo $info_employe['1'] . '<hr />'; // avec FETCH_NUM
// echo $info_employe -> prenom . '<hr />'; // avec FETCH_OBJ

/*
    $pdo représenteun objet[1] issue de la classe prédéfinie PDO
    Quand on execute une requete de sélection avec la méthode query sur notre objet $pdo:
    On obtient un nouvel objet[2] issue de la classe PDOStatement. Cet objet a donc des propriétés et méthodes différentes

    $resultat représente la réponse de la BDD et c'est un résultat inexploitable en l'état

    $info_employe est la réponse exploitable (grâce au fetch())
    /!\ attention, il faut choisir l'un des traitements fetch(PDO:: ...)
    Il n'est pas possible d'appliquer plusieurs traitement fetch sur un même résultat.

    Le résultat est la réponse sur la BDD et est inexploitable car Mysql nous renvoie beaucoup d'informations. Le fetch permet de les organiser.
*/

// 4. PDO: QUERY + WHILE + FETCH (plusieurs résultats)
$resultat = $pdo -> query("SELECT * FROM employes");
echo 'Le nombre d\'employes: ' . $resultat->rowCount() . '<br />'; // la méthode rowCount() de l'objet PDOStatement retourne le nombre de lignes dans notre résultat

while($info_employe = $resultat->fetch(PDO::FETCH_ASSOC))
{
    // à chaque tour de boucle, on traite avec un fetch la ligne en cours et on passe à la suivante
    // echo '<pre>'; print_r($info_employe); echo '</pre><hr />';
    echo '<div style="box-sizing: border-box; padding: 10px; background-color: darkred; color: white; display: inline-block; width: 23%; margin: 1%;">';

    echo 'id_employes: ' . $info_employe['id_employes'] . '<br />';
    echo 'nom: ' . $info_employe['nom'] . '<br />';
    echo 'prenom: ' . $info_employe['prenom'] . '<br />';
    echo 'salaire: ' . $info_employe['salaire'] . '<br />';
    echo 'sexe: ' . $info_employe['sexe'] . '<br />';
    echo 'service: ' . $info_employe['service'] . '<br />';
    echo 'date d\'embauche: ' . $info_employe['date_embauche'] . '<br />';

    echo '</div>';
}

// 5. EXERCICE
// récupérer la liste des BDD présents sur le serveur.
// les traiter puis les afficher dans une liste ul li
    // ATTENTION à l'indice si vous utilisez FETCH_ASSOC (les indices sont sensibles à la casse) Sur cette requete il y a une majuscule dans l'indice récupéré.

$databases = $pdo -> query("SHOW DATABASES");

echo '<ul>';
while($database_list = $databases->fetch(PDO::FETCH_NUM))
{
    echo '<li>' . $database_list[0] . '</li>'; 
    /*
    foreach($database_list AS $database)
    {
    echo '<li>' . $database . '</li>';
    }
    */
}
echo '</ul>';

// 6. PDO: QUERY + FETCHALL + FETCH_ASSOC (plusieurs resultats)
$resultat = $pdo->query('SELECT * FROM employes');

// fetchAll
$liste_employes = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($liste_employes); echo '</pre>'; echo '<hr />';
// fetchAll() traite toutes les lignes dans notre résultat et on obtient un tableau array multidimensionnel
// 1er niveau la ligne en cours, 2ème niveau les informations de la ligne

foreach($liste_employes AS $valeur)
{
    echo $valeur['prenom'] . '<br />';
}

// 7. PDO: QUERY + AFFICHAGE EN TABLEAU
$resultat = $pdo->query('SELECT * FROM employes');
echo '<hr />';

// balise ouverture du tableau
echo '<table border="1" style="width:80%; margin: 0 auto; border-collapse: collapse; text-align: center;">';

    // première ligne du tableau pour le nom des colonnes
    echo '<tr>';

        // récupération du nombre de colonnes dans la requête:
        $nb_col = $resultat->columnCount();

        for($i=0; $i<$nb_col; $i++)
        {
            // echo '<pre>'; print_r($resultat->getColumnMeta($i)); echo '</pre>'; echo '<hr />';
            $colonne = $resultat->getColumnMeta($i); // on récupère les informations de la colonne en cours afin ensuite de demander le name
            echo '<th style="padding: 10px;">' . $colonne['name'] . '</th>';
        }

    echo '</tr>';

    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC))
    {
        echo '<tr>';

        foreach($ligne AS $info)
        {
            echo '<td style="padding: 10px;">' . $info . '</td>';
        }

        echo '</tr>';
    }

echo '</table>';


//------------------------------------------------------------------\\
// ****************** SECURISATION DES DONNEES ***********************
//------------------------------------------------------------------\\

// 8. PDO: PREPARE + BINDPARAM + EXECUTE
$nom = 'Laborde';

$resultat = $pdo->prepare('SELECT * FROM employes WHERE nom = :nom'); // :nom est un marqueur nominatif

// nous pouvons maintenant fournir la valeur du marqueur :nom
$resultat->bindParam(':nom', $nom, PDO::PARAM_STR); // bindParam(nom_du_marqueur, valeur_du_marqueur, type_attendu)
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';

// BINDPARAM n'accepte que des valeurs sous forme de variable !!!

// implode() & explode() (fonctions prédéfinies)
// implode() permet d'afficher tous les éléments d'un tableau array séparés par un séparateur fourni en 1er argument
// explode() découpe une chaîne de caractères selon un séparateur fourni en 1er argument et place chaque segment de cette chaîne dans un tableau array à des indices différents.
// exemple:
echo implode('<br />', $donnees);

// 9. PDO: PREPARE + BINDVALUE + EXECUTE
echo '<hr /><hr /><hr />';
$resultat = $pdo->prepare('SELECT * FROM employes WHERE id_employes = :id');
$resultat->bindValue(':id', 350, PDO::PARAM_INT); //bindValue(nom_du_marqueur, valeur_du_marqueur, type_attendu)
$resultat->execute();
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
echo '<pre>'; print_r($donnees); echo '</pre>';

// BINDVALUE accepte une variable ou la valeur directement pour le marqueur (ce n'est pas le cas de bindParam qui n'accepte qu'une variable).
