<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require "BD.inc.php";

if(isset($_SESSION['id_user'])){

  $sql = "SELECT * FROM panier where id_user = :id_user and id_produit = :id_produit;";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["id_user" => $_SESSION['id_user'], "id_produit" => $_POST['id_produit']]);
  $panier = $stmt->fetch();

  $sql = "DELETE FROM panier where id_user = :id_user and id_produit = :id_produit;";
  $stmt = $conn->prepare($sql);
  $stmt->execute(["id_user" => $_SESSION['id_user'], "id_produit" => $_POST['id_produit']]);

  $sql = "UPDATE produits set quantite = quantite + :quantite where id = :id;";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':quantite' => $panier['quantite'], ':id' => $_POST['id_produit']));


} else {
  if (isset($_COOKIE['articles'])) {
      $articles = json_decode($_COOKIE['articles']);

      if (in_array($_POST['id_produit'], array_column($articles, 'id'))) {
          $id = array_search($_POST['id_produit'], array_column($articles, 'id'));

          unset($articles[$id]);
      }

      setcookie("articles", json_encode($articles), time() + (86400 * 30), "/");
  }
}
