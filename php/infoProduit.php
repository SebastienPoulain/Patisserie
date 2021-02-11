<?php

require "BD.inc.php";

$id = $_POST["id"];

$result = $conn->prepare("SELECT *  FROM produits WHERE id = :id");
$result->execute([':id' => $id]);
$result2 = $result->fetchAll(PDO::FETCH_ASSOC);

$output = "";

foreach ($result2 as $row) {
    $output .= '<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

    <h1 class="w3-center">Informations de la pâtisserie</h1>

<div class="w3-card w3-sand w3-padding-4 w3-round-xlarge w3-show-inline-block w3-margin-left w3-margin-bottom w3-col m12">
    <div class="w3-col m5">
        <img src="' . $row["image"] . '" class="w3-image w3-padding-48" style="margin-left: auto; margin-right: auto; width: 50%; display: block;">
    </div>
    <div class="w3-col m7 ">
        <p class="w3-margin-left">
            <h2>' . $row["nom"] . '</h2>
            <p>Sorte de patisserie : ' . $row["sorte"] . '</p>
            <p>
                <div>
                    <span>Quantité </span>
                    <i id="moins" style="cursor:pointer" class="fas fa-minus-square"></i>
                    <input type="number" class="w3-center" min="1" max="' . $row["quantite"] . '" value="1" name="quantite" id="quantite">
                    <i id="plus" style="cursor:pointer" class="fas fa-plus-square"></i>
                </div>
                <p>
                    <p>Quantité disponible : <span>' . $row["quantite"] . '</span></p>
                </p>
                <p>
                    <p>Prix : <span>' . $row["prix"] . ' $</span></p>
                </p>
               <a href="' . $row["pdf"] . '" class="w3-button w3-brown" download>Télécharger les informations de la pâtisserie</a>
            </p>

            <input id="submit" style="cursor:pointer" type="submit" value="Ajouter au panier" class="w3-padding w3-margin-top w3-brown w3-margin-bottom add-cart" >
    </div>
    <div class=" w3-row w3-margin-bottom">
        <a href="javascript:void(0)" onclick="infoPat(event, \'details\');">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Détails</div>
        </a>
        <a href="javascript:void(0)" onclick="infoPat(event, \'allergenes\');">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Allergènes</div>
        </a>
        <a href="javascript:void(0)" onclick="infoPat(event, \'ingredients\');">
            <div class="w3-third tablink w3-bottombar w3-hover-light-grey w3-padding">Ingrédients</div>
        </a>
        <div id="details" class="w3-container infoPath" style="display:none">
            <h2>Détails</h2>
            <p>' . $row["details"] . '</p>
        </div>

        <div id="allergenes" class="w3-container infoPath" style="display:none">
            <h2>Allergènes</h2>
            <p>' . $row["allergene"] . '</p>
        </div>

        <div id="ingredients" class="w3-container infoPath" style="display:none">
            <h2>Ingrédients</h2>
            <p>' . $row["ingredients"] . '</p>
        </div>
    </div>
</div>
</div>

</div>';
}
echo $output;
$conn = null;
