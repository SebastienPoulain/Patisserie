<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])){

  $sql = "SELECT * from panier where id_user = :id_user;";
  $stmt = $conn->prepare($sql);
  $stmt->execute(array(':id_user' => $_SESSION['id_user']));
  $panier = $stmt;

  $sql = "UPDATE panier set quantite = :quantite where id_user = :id_user and id_produit = :id_produit;";
  $stmt = $conn->prepare($sql);

  for ($i=0; $i < count($_POST['articles']); $i++) {
    $stmt->execute(array(':quantite' => $_POST['quantites'][$i], ':id_user' => $_SESSION['id_user'], ':id_produit' => $_POST['articles'][$i]));
  }

  $sql = "UPDATE produits set quantite = :quantite where id = :id_produit;";
  $stmt = $conn->prepare($sql);

  $ctr = 0;
  while ($row = $panier->fetch()) {
    if ($row['quantite'] > $_POST['quantites'][$ctr]){
      $qte = $row['quantite'] - $_POST['quantites'][$ctr];

      $sql = "UPDATE produits set quantite = quantite + :quantite where id = :id_produit;";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':quantite' => $qte, ':id_produit' => $row['id_produit']));

    } elseif ($row['quantite'] < $_POST['quantites'][$ctr]) {
      $qte = $_POST['quantites'][$ctr] - $row['quantite'];

      $sql = "UPDATE produits set quantite = quantite - :quantite where id = :id_produit;";
      $stmt = $conn->prepare($sql);
      $stmt->execute(array(':quantite' => $qte, ':id_produit' => $row['id_produit']));
    }
    $ctr++;
  }
  echo "success";

} else {
  if (isset($_COOKIE['articles'])) {
      $articles = json_decode($_COOKIE['articles']);

      for ($i=0; $i < count($_POST['articles']); $i++) {
        if (in_array($_POST['articles'][$i], array_column($articles, 'id'))) {
            $id = array_search($_POST['articles'][$i], array_column($articles, 'id'));
            $articles[$id] = array('id' => $_POST['articles'][$i], 'qte' => $_POST['quantites'][$i]);
        }
      }

      setcookie("articles", json_encode($articles), time() + (86400 * 30), "/");
      echo "success";
  }
}
