<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "BD.inc.php";

$req = $conn->prepare("SELECT * FROM utilisateurs WHERE id = :id");
$req->execute(array(':id' => $_SESSION['id_user']));
$user = $req->fetch();

$currentPass = $user["password"];

$ancienPass = hash("SHA256", trim($_POST["apass"]));

if ($ancienPass == $currentPass) {
    $req = $conn->prepare("UPDATE utilisateurs SET password = ? WHERE id = ? ");
    $req->execute([hash("SHA256", $_POST["pass"]), $user["id"]]);
    echo "Votre mot de passe a été changé avec succès";
} else {
    echo "L'ancien mot de passe ne correspond pas à celui actuel";
}

$conn = null;
