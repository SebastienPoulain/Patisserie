<?php
$servername = "localhost";
$username = "id16081079_root";
$password = "5o3|zjz*dX}p(zQP";
$dbname = "id16081079_patisserie";

try {
    $conn = new PDO('mysql:host=' . $servername . ';dbname=' . $username, $username, $password, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connState = "Connected successfully";
} catch (PDOException $e) {
    $connState = "Connection failed: " . $e->getMessage();
}

// Fermer la connexion après chaque utilisation avec $conn = null;
?>
