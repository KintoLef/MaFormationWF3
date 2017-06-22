<?php
// la superglobale $_SESSION est disponible partout sur le serveur

session_start(); 

echo '<pre>'; print_r($_SESSION); echo '</pre>';
