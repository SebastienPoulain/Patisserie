<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

    if (isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])) {
        $table = "";

        $sql = "SELECT * from panier where id_user = :id_user;";
        $stmt = $conn->prepare($sql);
        $stmt->execute(array(':id_user' => $_SESSION['id_user']));

        $panier = $stmt->fetchAll();

        if ($panier) {
            foreach ($panier as $article) {
                $sql = "SELECT * from produits where id = :id";
                $stmt = $conn->prepare($sql);
                $stmt->execute(array(":id" => $article["id_produit"]));
                $produit = $stmt->fetch();

                $prixTotal = $article['quantite'] * $produit['prix'];

                $table .= "<tr><td id='".$produit['id']."'>".$produit['nom']."</td><td><i style='cursor:pointer' class='fas fa-minus-square moins'></i><input type='number' class='w3-center quantite' style='width: 75%;' min='1' max='".$produit['quantite']."' value='".$article['quantite']."'><i style='cursor:pointer' class='fas fa-plus-square plus'></i></td><td>".$produit['prix']."</td><td class='prixT'>".$prixTotal."</td><td><button id='".$produit['id']."' class='w3-btn w3-round w3-red' name='delete'><i class='fas fa-trash'></i> Supprimer</button></td></tr>";
            }

            echo $table;
        } else {
            echo "empty";
        }
    } else {
        if (isset($_COOKIE['articles'])) {
            $articles = json_decode($_COOKIE['articles']);
            $table = "";

            $sql = "SELECT * from produits where id = :id";
            $stmt = $conn->prepare($sql);

            for ($i=0; $i < count($articles); $i++) {
                $stmt->execute(array(':id' => array_column($articles, 'id')[$i]));
                $produit = $stmt->fetch();

                $prixTotal = array_column($articles, 'qte')[$i] * $produit['prix'];

                $table .= "<tr><td id='".$produit['id']."'>".$produit['nom']."</td><td><i style='cursor:pointer' class='fas fa-minus-square moins'></i><input type='number' class='w3-center quantite' style='width: 75%;' min='1' max='".$produit['quantite']."' value='".array_column($articles, 'qte')[$i]."'><i style='cursor:pointer' class='fas fa-plus-square plus'></i></td><td>".$produit['prix']."</td><td class='prixT'>".$prixTotal."</td><td><button id='".$produit['id']."' class='w3-btn w3-round w3-red' name='delete'><i class='fas fa-trash'></i> Supprimer</button></td></tr>";
            }

            echo $table;
        } else {
            echo "empty";
        }
    }


$conn = null;
