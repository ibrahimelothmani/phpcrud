<?php

$host = 'localhost';
$sgdb = 'mysql';
$user = 'root';
$pass = '';
$dbname = 'test';
$charset = 'utf8'; // Correction du jeu de caractères

$db = $sgdb . ':host=' . $host . ';dbname=' . $dbname . ';charset=' . $charset;

// Connexion à la base de données
try {
    $cn = new PDO($db, $user, $pass);
} catch (PDOException $e) {
    echo 'Connexion échouée. Error : ' . $e->getMessage() . '<br>';
    die();
}

?>

