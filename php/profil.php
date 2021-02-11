<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "BD.inc.php";

if (isset($_SESSION["rue"])) {
    $result = $conn->prepare("UPDATE adresseClients SET numcivic = :numcivic,rue = :rue,ville = :ville,pays = :pays, codepostal = :codepostal, numtel = :numtel  where id_user = :id_user");
    if ($result->execute(array(':numcivic' => $_POST["numcivic"], ':rue' => $_POST["rue"], ':ville' => $_POST["ville"], ':pays' => $_POST["pays"], ':codepostal' => $_POST["codepostal"], ':numtel' => $_POST["tel"], ':id_user' => $_SESSION["id_user"]))) {
        $_SESSION["numcivic"] = $_POST["numcivic"];
        $_SESSION["rue"] = $_POST["rue"];
        $_SESSION["ville"] = $_POST["ville"];
        $_SESSION["pays"] = $_POST["pays"];
        $_SESSION["codepostal"] = $_POST["codepostal"];
        $_SESSION["tel"] = $_POST["tel"];
        echo "Le profil a été modifié";
    } else {
        echo "Le profil n'a pas pu être modifié";

    }
} else {
    $result = $conn->prepare("INSERT INTO adresseClients (id_user,numcivic,rue,ville,pays,codepostal,numtel) VALUES (:id_user,:numcivic,:rue,:ville,:pays,:codepostal,:numtel)");
    if ($result->execute(array(':id_user' => $_SESSION["id_user"], ':numcivic' => $_POST["numcivic"], ':rue' => $_POST["rue"], ':ville' => $_POST["ville"], ':pays' => $_POST["pays"], ':codepostal' => $_POST["codepostal"], ':numtel' => $_POST["tel"]))) {
        echo "Votre profil a été modifié";
    } else {
        echo "Votre profil n'a pas pu être modifié";
    }
}
$conn = null;
