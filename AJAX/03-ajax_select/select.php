<?php

$tab = array();
$tab['resultat'] = "";

if(!empty($_POST['pays']))
{
    // exercice: renvoyer dans $tab['resultat'] les villes selon la valeur de l'indice pays
    // sous forme '<option>ville1</option><option>ville2</option>'

    $pays = $_POST['pays'];
    if($pays == 'France')
    {
        $tab['resultat'] = "<option>Paris</option><option>Bordeaux</option>";
    }
    elseif($pays == 'Italie')
    {
        $tab['resultat'] = "<option>Rome</option><option>Venise</option>";
    }
    elseif($pays == 'Espagne')
    {
        $tab['resultat'] = "<option>Madrid</option><option>Seville</option>";
    }
}

echo json_encode($tab);