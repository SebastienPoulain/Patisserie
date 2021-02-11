<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$qte = 0;

if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
    $sql = "SELECT * from panier where id_user = :id_user;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id_user' => $_SESSION['id_user']));

    while ($row = $stmt->fetch()) {
        $qte += intval($row['quantite']);
    }
} else {
  if (isset($_COOKIE['articles'])) {
    $articles = json_decode($_COOKIE['articles']);

    for ($i=0; $i < count($articles); $i++) {
      $qte += intval(array_column($articles, 'qte')[$i]);
    }
  }
}
$_SESSION['articlectr'] = $qte;
