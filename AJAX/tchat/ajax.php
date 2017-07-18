<?php
require_once('inc/init.inc.php');

$tab = array();
$tab['resultat'] = "";

$arg = isset($_POST['arg']) ? $_POST['arg'] : "";
$mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if($mode == 'liste_membre_connecte' && !empty($arg) && $arg == 'retirer')
{
    // si on rentre ici, nous devons retirer un pseudo du fichier pseudo.txt // attention au sens entre cette condition et la suivante car la valeur de $mode est la même pour les deux

    // on récupère le contenu de pseudo.txt
    $contenu = file_get_contents('pseudo.txt');

    // on remplace dans la chaîne de caractères représentée pas $contenu, le pseudo par rien (pour le supprimer)
    $contenu = str_replace($_SESSION['utilisateur']['pseudo'], '', $contenu);

    // on remet le contenu modifié dans le fichier
    file_put_contents('pseudo.txt', $contenu);
}
elseif($mode == 'liste_membre_connecte')
{
    // si on rentre ici, nous devons récupérer la liste des membres sur le fichier pseudo.txt puis la renvoyer
    $fichier = file("pseudo.txt");
    if(!empty($fichier))
    {
        // implode() permet de récupérer les valeurs d'un tableau array et de les renvoyer sous forme de chaîne de caractère séparée par séparateur fourni en premier argument
        $tab['resultat'] .= '<p>' . implode('</p><p>', $fichier) . '</p>';
    }
}
elseif($mode == "postMessage")
{
    // si la valeur de mode est égal à postMessage alors nous devons enregistrer le message de l'utilisateur en BDD
    if(!empty($arg)) // $arg est censé contenir le message à enregistrer, donc s'il n'est pas vide on l'enregistre
    {
        $id = $_SESSION['utilisateur']['id_membre'];
        $enregistrement = $pdo->prepare("INSERT INTO dialogue (id_membre, message, date_dialogue) VALUES ($id, :message, NOW())");
        $enregistrement->bindParam(':message', $arg, PDO::PARAM_STR);
        $enregistrement->execute();

        $tab['resultat'] .= '<br><p>Message enregistré</p>';
    }
}
elseif($mode == "message_tchat")
{
    // Exercice: récupérer tous les messages de la BDD ainsi que les pseudo correspondant et les renvoyer dans $tab['resultat']. Chaque message doit être affiché sous la forme: pseudo > message. Faire en sorte que les pseudo homme soient bleu et celui des femmes soient rose.
    $message = $pdo->query('SELECT m.pseudo, d.message, m.sexe FROM membre m, dialogue d WHERE m.id_membre = d.id_membre ORDER BY d.date_dialogue');
    
    
    while($msg = $message->fetch(PDO::FETCH_ASSOC))
    {
        if($msg['sexe'] == 'm')
        {
            $tab['resultat'] .= '<p><span class="bleu">' . $msg['pseudo'] . '</span> > ' . $msg['message'] . '</p>';
        }
        elseif($msg['sexe'] == 'f')
        {
            $tab['resultat'] .= '<p><span class="rose">' . $msg['pseudo'] . '</span> > ' . $msg['message'] . '</p>';
        }            
    }    
    
}

// envoi de la réponse en encodant sous le format JSON
echo json_encode($tab);