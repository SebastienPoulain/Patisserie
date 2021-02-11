<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['id']) && isset($_POST['qte'])) {
    if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
        $sql = "SELECT * from panier where id_produit = :id and id_user = :id_user;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $_POST['id'], ':id_user' => $_SESSION['id_user']));

        $item = $stmt->fetch();

        if ($item) {
            $sql = "UPDATE panier set quantite = quantite + :qte where id_produit = :id and id_user = :id_user;";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $_POST['id'], ':id_user' => $_SESSION['id_user'], ':qte' => $_POST['qte']));
        } else {
            $sql = "INSERT INTO panier(id_produit, id_user, quantite) values(:id, :id_user, :qte);";
            $stmt = $conn->prepare($sql);
            $stmt->execute(array(':id' => $_POST['id'], ':id_user' => $_SESSION['id_user'], ':qte' => $_POST['qte']));
        }

        $sql = "UPDATE produits set quantite = quantite - :qte where id = :id;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id' => $_POST['id'], ':qte' => $_POST['qte']));


        echo "success";
    } else {
        $articles = [];

        if (isset($_COOKIE['articles'])) {
            $articles = json_decode($_COOKIE['articles']);
        } else {
            $articles = [];
        }

        if (in_array($_POST['id'], array_column($articles, 'id'))) {
            $id = array_search($_POST['id'], array_column($articles, 'id'));

            $articles[$id] = array('id' => $_POST['id'], 'qte' => intval(array_column($articles, 'qte')[$id]) + $_POST['qte']);
        } else {
            array_push($articles, array('id' => $_POST['id'], 'qte' => $_POST['qte']));
        }

        setcookie("articles", json_encode($articles), time() + (86400 * 30), "/");

        echo "success";
    }
} else {
    echo "error_field_notset";
}

$conn = null;
