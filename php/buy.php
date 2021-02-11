<?php

require 'BD.inc.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$_SESSION['articlectr'] = 0;

if (isset($_POST['id'])) {

    $address_line_2 = null;

    if (isset($_POST['address_line_2']) && !empty($_POST['address_line_2'])){
      $address_line_2 = $_POST['address_line_2'];
    }

    $sql = "INSERT INTO commandes(id, id_user, prixtotal) values(:id, :id_user, :prixT);";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id' => $_POST['id'], ':id_user' => $_SESSION['id_user'], ':prixT' => $_SESSION['prixT']));

    $sql = "INSERT INTO adresseCommandes(id_commande, address_line_1, address_line_2, ville, province_code, postal_code, country_code) values(:id_commande, :address_line_1, :address_line_2, :ville, :province_code, :postal_code, :country_code);";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id_commande' => $_POST['id'], ':address_line_1' => $_POST['address_line_1'], ':address_line_2' => $address_line_2, ':ville' => $_POST['ville'], ':province_code' => $_POST['province'], ':postal_code' => $_POST['postal_code'], ':country_code' => $_POST['country_code']));

    $sql = "INSERT INTO produitsCommande(id_commande, id_produit, quantite) values(:id, :id_produit, :qte);";
    $stmt = $conn->prepare($sql);

    for ($i=0; $i < count($_SESSION['articles']); $i++) {
      $stmt->execute(array(':id' => $_POST['id'], ':id_produit' => $_SESSION['articles'][$i], ':qte' => $_SESSION['quantites'][$i]));
    }

    $sql = "DELETE FROM panier where id_user = :id_user;";
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':id_user' => $_SESSION['id_user']));

    $date = date("Y-m-d h:i:s");

    $result = $conn->prepare("SELECT produitsCommande.quantite, produits.nom,produits.prix from produitsCommande inner join produits on produits.id = produitsCommande.id_produit WHERE produitsCommande.id_commande = :id_commande ORDER BY produitsCommande.id DESC");
    $result->execute([":id_commande" => $_POST['id']]);
    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);
    $i = 1;
if($address_line_2 == ""){
  $address_line_2 = "N/A";
}
    $to = $_SESSION["email"];
    $sujet = "Commande de pâtisseries";
    $headers = "MIME-Version: 1.0" . "\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\n";
    $headers .= 'From: ' . "delicesetmerveilles@cweb12.expertiseweb.ca";
    $message = '<h1 style="text-align:center;">Récapitulatif de la commande #' .$_POST['id'] ."\n" ."</h1>" .' <table width="100%" border="1" cellspacing="1" cellpadding="2">
    <tr><td style="text-align:center;" width="20%">Adresse</td><td style="text-align:center;"  width="80%">' . $_POST['address_line_1'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Adresse 2</td><td style="text-align:center;" width="20%">' . $address_line_2 . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Ville</td><td style="text-align:center;"  width="80%">' . $_POST['ville'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Code de province</td><td style="text-align:center;" width="20%">' . $_POST['province'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Code postal</td><td style="text-align:center;"  width="80%">' . $_POST['postal_code'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Code de pays</td><td style="text-align:center;" width="20%">' . $_POST['country_code'] . '</td></tr>  </table> <br>';
    $message.='<table width="100%" border="1" cellspacing="1" cellpadding="2">
    <tr><td style="text-align:center;" width="20%">Numéro de la commande</td><td style="text-align:center;" width="20%">' . $_POST['id'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Prix total</td><td style="text-align:center;" width="20%">' . $_SESSION['prixT'] . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Date de commande</td><td style="text-align:center;"  width="80%">' . $date . '</td></tr>
    <tr><td style="text-align:center;" width="20%">Statut</td><td style="text-align:center;" width="20%">' . "En attente" . '</td></tr> </table> <br>';
    $message.='<table width="100%" border="1" cellspacing="1" cellpadding="2">';
     foreach ($result2 as $row) {
      $message.= ' <tr><td style="text-align:center;" width="20%">Produit ' . $i . '</td><td style="text-align:center;" width="20%">' . $row["nom"] . " X" . $row["quantite"]. '</td></tr>';
      $i++;
     }
     $message.= '
    </table>';

    mail($to, $sujet, $message, $headers);

    echo "success";
} else {
    echo "error_field_notset";
}

$conn = null;
