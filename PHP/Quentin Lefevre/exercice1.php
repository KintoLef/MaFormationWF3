<?php

$date = new DateTime('1990-08-20');

$presentation = array();
$presentation['Prenom']   = 'Quentin';
$presentation['Nom']   = 'Lefevre';
$presentation['Adresse']   = '1 rue Robert Schuman';
$presentation['CP']   = '78660';
$presentation['Ville']  = 'Ablis';
$presentation['Email']  = 'quinto_lefevre@hotmail.com';
$presentation['Tel']  = '06.67.38.78.63';
$presentation['Date_Naissance']  = $date->format('d-m-Y');



foreach($presentation AS $indice => $valeur)
{
    echo '<ul><li>' . $indice . ': ' . $valeur . '</li></ul>';
}
 