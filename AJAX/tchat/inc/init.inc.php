<?php
// connexion BDD
$pdo = new PDO('mysql:host=localhost;dbname=wf3_tchat', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

// ouverture de la session
session_start();
