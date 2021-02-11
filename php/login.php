<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_POST["email"];
    $password = hash('SHA256', $_POST["password"]);

    $sql = "SELECT * FROM utilisateurs WHERE email = LOWER(:email) AND password = :password;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':email' => $email, ':password' => $password));
    $user = $stmt->fetch();

    $sql2 = "SELECT * FROM adresseClients WHERE id_user = :id";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute(array(':id' => $user['id']));
    $userExists = $stmt2->fetch();

    if ($userExists) {
        $_SESSION["numcivic"] = $userExists["numcivic"];
        $_SESSION["rue"] = $userExists["rue"];
        $_SESSION["ville"] = $userExists["ville"];
        $_SESSION["pays"] = $userExists["pays"];
        $_SESSION["codepostal"] = $userExists["codepostal"];
        $_SESSION["tel"] = $userExists["numtel"];
    }

    if ($user) {
        $_SESSION['id_user'] = $user['id'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['prenom'] = $user['prenom'];
        $_SESSION['type'] = $user['type'];

        if (isset($_COOKIE['articles'])) {
            $articles = json_decode($_COOKIE['articles']);

            for ($i=0; $i < count($articles); $i++) {

              $sql = "SELECT * from panier where id_produit = :id and id_user = :id_user;";
              $stmt = $conn->prepare($sql);
              $stmt->execute(array(':id' => array_column($articles, 'id')[$i], ':id_user' => $_SESSION['id_user']));

              $item = $stmt->fetch();

              if ($item) {
                  $sql = "UPDATE panier set quantite = quantite + :qte where id_produit = :id and id_user = :id_user;";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute(array(':id' => array_column($articles, 'id')[$i], ':id_user' => $_SESSION['id_user'], ':qte' => array_column($articles, 'qte')[$i]));
              } else {
                  $sql = "INSERT INTO panier(id_produit, id_user, quantite) values(:id, :id_user, :qte);";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute(array(':id' => array_column($articles, 'id')[$i], ':id_user' => $_SESSION['id_user'], ':qte' => array_column($articles, 'qte')[$i]));
              }

              $sql = "UPDATE produits set quantite = quantite - :qte where id = :id;";
              $stmt = $conn->prepare($sql);
              $stmt->execute(array(':id' => array_column($articles, 'id')[$i], ':qte' => array_column($articles, 'qte')[$i]));


            }

            setcookie("articles", json_encode($articles), time() - 3600, "/");

        }

        echo "success";
    } else {
        echo "error_user_not_found";
    }
} else {
    echo "error_empty_field";
}

$conn = null;
