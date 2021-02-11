<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_POST["type"] == "U") {

    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nom"]) && isset($_POST["prenom"])) {

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $password = hash('SHA256', $_POST["password"]);

        $sql = "SELECT COUNT(ID) FROM utilisateurs WHERE email = LOWER(:email);";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
            echo "error_user_exists";
        } else {
            $sql = "INSERT INTO utilisateurs(email, password, nom, prenom, type) VALUES(LOWER(:email), :password, :nom, :prenom, 'U');";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':email' => $email, ':password' => $password, ':nom' => $nom, ':prenom' => $prenom));

            echo "success";
        }

    } else {
        echo "error_empty_field";
    }
} else {
    if (isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["nom"]) && isset($_POST["prenom"])) {

        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $password = hash('SHA256', $_POST["password"]);

        $sql = "SELECT COUNT(ID) FROM utilisateurs WHERE email = LOWER(:email);";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':email' => $email));
        $userExists = $stmt->fetchColumn();

        if ($userExists > 0) {
            echo "error_user_exists";
        } else {
            $sql = "INSERT INTO utilisateurs(email, password, nom, prenom, type) VALUES(LOWER(:email), :password, :nom, :prenom, 'A');";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':email' => $email, ':password' => $password, ':nom' => $nom, ':prenom' => $prenom));

            echo "success";
        }

    } else {
        echo "error_empty_field";
    }
}
$conn = null;
