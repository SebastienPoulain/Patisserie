<?php

if (isset($_POST["action"])) {

    require "BD.inc.php";
}

if ($_POST["action"] == "fetch") {
    $result = $conn->prepare("SELECT *  FROM produits WHERE statut = '1' AND quantite != '0' ");
    $result->execute();

    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

    $output = "";

    foreach ($result2 as $row) {
        $output .= '<div class="w3-card w3-sand w3-padding-16 w3-round-xlarge w3-show-inline-block w3-margin-left w3-margin-bottom">
<div class=" w3-container w3-center" style="width:100%;">
    <a href="?page=patisserie&id=' . $row["id"] . '"><img class="w3-image" src="' . $row["image"] . '" style="max-height: 210px;"></a>
    <a href="?page=patisserie&id=' . $row["id"] . '"><h4>' . $row["nom"] . '</h4></a>
    <h5 class="w3-text-grey">$' . $row["prix"] . '</h5>
    <button id="'.$row["id"].'" data-qtemax="'.$row["quantite"].'" class="w3-button w3-brown w3-block add-cart" onclick="addtocart(this)"><i class="fas fa-cart-plus w3-hide-medium"></i><span class="w3-hide-small"> Ajouter au panier</span></button>
</div>
</div> ';
    }
    echo $output;
}

if ($_POST["action"] == "recherche") {

    $output = "";
    $txt = $_POST["txt"];
    $txt = '%' . $txt . '%';

    if ($txt != "%%") {
        $query = "SELECT * FROM produits WHERE statut = '1' AND quantite != '0' AND nom LIKE '$txt'";
    } else {

        $query = "
      SELECT * FROM produits WHERE statut = '1'
     ";

        $query .= "AND quantite != '0'";

        $query .= "
       AND prix BETWEEN '" . $_POST["min"] . "' AND '" . $_POST["max"] . "'
      ";

        $noisette = $_POST["sorte"][0];
        $chocolat = $_POST["sorte"][1];
        $framboise = $_POST["sorte"][2];
        $marron = $_POST["sorte"][3];

        if ($noisette != "" || $chocolat != "" || $framboise != "" || $marron != "") {

            $sorte = implode("','", $_POST["sorte"]);

            $query .= "
       AND sorte IN('" . $sorte . "')
      ";
        }
    }
    $result = $conn->prepare($query);
    $result->execute();

    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result2 as $row) {
        $output .= '<div class="w3-card w3-sand w3-padding-16 w3-round-xlarge w3-show-inline-block w3-margin-left w3-margin-bottom">
    <div class=" w3-container w3-center ">
    <a href="?page=patisserie&id=' . $row["id"] . '"><img class="w3-image" src="' . $row["image"] . '" style="max-height: 210px;"></a>
    <a href="?page=patisserie&id=' . $row["id"] . '"><h4>' . $row["nom"] . '</h4></a>
    <h5 class="w3-text-grey">$' . $row["prix"] . '</h5>
    <button id="'.$row["id"].'" data-qtemax="'.$row["quantite"].'" class="w3-button w3-brown w3-block add-cart" onclick="addtocart(this)"><i class="fas fa-cart-plus w3-hide-medium"></i><span class="w3-hide-small"> Ajouter au panier</span></button>
</div>
</div> ';
    }
    echo $output;
}

$conn = null;
