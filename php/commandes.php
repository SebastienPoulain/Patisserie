<?php

  if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    require "BD.inc.php";

if ($_POST["action"] == "fetch") {



    $result = $conn->prepare("SELECT * from commandes WHERE id_user = :id_user ORDER BY datecommande DESC");
    $result->execute(["id_user" => $_SESSION["id_user"]]);
    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);
    $statut = "";

    $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th style="width: 20%">
        Numéro de commande
        </th>
        <th style="width: 20%">
        Prix total
        </th>
        <th style="width: 20%">
        Date de commande
       </th>
       <th style="width: 20%">
      Statut
      </th>
      <th style="width: 20%">
     Action
      </th>
      </tr>
    </thead>
    ';
    foreach ($result2 as $row) {
        if ($row["statut"] == "A") {
            $statut = "En attente";
        } else if ($row["statut"] == "E") {
            $statut = "En cours de livraison";
        } else {
            $statut = "Livré";
        }
        $output .= '

    <tr class="w3-center">
        <td> ' .
            $row['id'] . '
        </td>
        <td>
        ' .
            $row['prixtotal'] . '$' . '
        </td>
        <td>
        ' .
            $row['datecommande'] . '
        </td>
        <td>
        ' .
            $statut . '
        </td>
        <td>
        <a class="w3-button w3-grey w3-round" href="?page=commande_details&id='.$row['id'].'">
                <i class="fas fa-info-circle"></i>
              Détails
              </a>
              </td>
     </tr>
     ';

    }
    $output .= '</tbody> </table>';
    echo $output;
}

if ($_POST["action"] == "fetchs") {



    $result = $conn->prepare("SELECT commandes.id,commandes.prixtotal,commandes.datecommande,commandes.statut,utilisateurs.email,utilisateurs.prenom,utilisateurs.nom from commandes inner join utilisateurs on utilisateurs.id = commandes.id_user ORDER BY datecommande DESC");
    $result->execute();
    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);
    $statut = "";
    $selectedA = false;
    $selectedE = false;
    $selectedL = false;

    $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
      <th style="width: 14%">
      Nom
      </th>
      <th style="width: 14%">
     Courriel
      </th>
        <th style="width: 14%">
        Numéro de commande
        </th>
        <th style="width: 14%">
        Prix total
        </th>
        <th style="width: 14%">
        Date de commande
       </th>
       <th style="width: 14%">
      Statut
      </th>
      <th style="width: 14%">
     Action
      </th>
      </tr>
    </thead>
    ';
    foreach ($result2 as $row) {
        $selectedA = false;
        $selectedE = false;
        $selectedL = false;

        if ($row["statut"] == "A") {
            $statut = "En attente";
            $selectedA = true;
        } else if ($row["statut"] == "E") {
            $statut = "En cours de livraison";
            $selectedE = true;
        } else {
            $statut = "Livré";
            $selectedL = true;
        }
       
    
        $output .= '

    <tr class="w3-center">
    <td> ' .
    $row['prenom'] . " " .  $row['nom'] . '
    </td>
    <td>
    ' .
    $row['email'] . '
    </td>
        <td> ' .
            $row['id'] . '
        </td>
        <td>
        ' .
            $row['prixtotal'] . '$' . '
        </td>
        <td>
        ' .
            $row['datecommande'] . '
        </td>
        <td>
        <select class="w3-select w3-border w3-margin-bottom w3-round-large statutCommande">
        <option value="A" '; if($selectedA == true) {$output .= ' selected '; } $output .= ' >En attente</option>
        <option value="E" '; if($selectedE == true) { $output .= ' selected '; } $output .= '>En cours de livraison</option>
        <option value="L" '; if($selectedL == true)  {$output .= ' selected';} $output .= '>Livré</option>
       </select>
        </td>
        <td>
        <a id = "'.$row['id'].'" class="w3-button w3-blue-grey w3-round w3-margin-bottom update" href="#">
        <i class="fas fa-edit"></i>
      Modifier le statut
      </a>
        <a class="w3-button w3-grey w3-round" href="?page=commande_details&id='.$row['id'].'">
                <i class="fas fa-info-circle"></i>
              Détails de la commande
              </a>
              </td>
     </tr>
     ';

    }
    $output .= '</tbody> </table>';
    echo $output;
}

if($_POST["action"] == "fetch_details"){

    $result = $conn->prepare("SELECT * from commandes WHERE id = :id ORDER BY id DESC");
    $result->execute(["id" => $_POST["id_commande"]]);
    $result2 = $result->fetch();
    $statut = "";

    $output = '
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th style="width: 25%">
        Numéro de commande
        </th>
        <th style="width: 25%">
        Prix total
        </th>
        <th style="width: 25%">
        Date de commande
       </th>
       <th style="width: 25%">
      Statut
      </th>
      </tr>
    </thead>
    ';

        $idCommande = $result2["id"];
        if ($result2["statut"] == "A") {
            $statut = "En attente";
        } else if ($result2["statut"] == "E") {
            $statut = "En cours de livraison";
        } else {
            $statut = "Livré";
        }
        $output .= '

    <tr class="w3-center">
        <td> ' .
            $result2['id'] . '
        </td>
        <td>
        ' .
            $result2['prixtotal'] . '$' . '
        </td>
        <td>
        ' .
            $result2['datecommande'] . '
        </td>
        <td>
        ' .
            $statut . '
        </td>
     </tr>
     ';


    $output .= '</tbody> </table>';
    echo $output;

    $result = $conn->prepare("SELECT produitsCommande.quantite, produits.nom,produits.prix from produitsCommande inner join produits on produits.id = produitsCommande.id_produit WHERE produitsCommande.id_commande = :id_commande ORDER BY produitsCommande.id DESC");
    $result->execute([":id_commande" => $idCommande]);
    $result2 = $result->fetchAll(PDO::FETCH_ASSOC);

    $output = ' <h2 class="w3-center"> Liste des produits </h2>
    <table class="w3-table-all w3-center">
    <thead>
      <tr>
        <th class="w3-center" style="width: 33%">
       Produit
        </th>
        <th class="w3-center" style="width: 33%">
       Quantité
        </th>
        </th>
        <th class="w3-center" style="width: 33%">
         Prix
        </th>
      </tr>
    </thead>
    ';
    foreach ($result2 as $row) {
       $prix = $row["prix"];
       $quantite = $row["quantite"];
        $output .= '

    <tr class="w3-center">
        <td class="w3-center"> ' .
            $row['nom'] . '
        </td>
        <td class="w3-center">
        ' .
            $row['quantite'] . '
        </td>
        <td class="w3-center">
        ' .
           $quantite * $prix . "$" . '
        </td>
     </tr>
     ';

    }
    $output .= '</tbody> </table>';
    echo $output;


}

if($_POST["action"] == "modifier"){
    
    $sql = "UPDATE commandes set statut = :statut where id = :idCommande ";
    $stmt = $conn->prepare($sql);
if($stmt->execute(array(':statut' => $_POST["statut"] , ':idCommande' => $_POST["idCommande"] ))){
    echo "Le statut de votre commande a été modifié";
}
else{
    echo "Le statut de votre commande n'a pas pu être modifié";
}
    
}

if($_POST["action"] == "recherche"){
$output = "";

if ($_POST["statut"] == "jour") {
    $sql = "SELECT commandes.id,commandes.prixtotal,commandes.datecommande,commandes.statut,utilisateurs.email,utilisateurs.prenom,utilisateurs.nom from commandes inner join utilisateurs on utilisateurs.id = commandes.id_user WHERE commandes.datecommande >= DATE_ADD(CURDATE(), INTERVAL -1 DAY)  ORDER BY commandes.datecommande DESC";
}
if ($_POST["statut"] == "mois") {
    $sql = "SELECT commandes.id,commandes.prixtotal,commandes.datecommande,commandes.statut,utilisateurs.email,utilisateurs.prenom,utilisateurs.nom from commandes inner join utilisateurs on utilisateurs.id = commandes.id_user WHERE commandes.datecommande >= DATE_ADD(CURDATE(), INTERVAL -30 DAY) ORDER BY commandes.datecommande DESC";
}
if ($_POST["statut"] == "annee") {
    $sql = "SELECT commandes.id,commandes.prixtotal,commandes.datecommande,commandes.statut,utilisateurs.email,utilisateurs.prenom,utilisateurs.nom from commandes inner join utilisateurs on utilisateurs.id = commandes.id_user WHERE commandes.datecommande >= DATE_ADD(CURDATE(), INTERVAL -365 DAY) ORDER BY commandes.datecommande DESC";
}

$result = $conn->prepare($sql);
$result->execute();
$result2 = $result->fetchAll(PDO::FETCH_ASSOC);
$statut = "";
$selectedA = false;
$selectedE = false;
$selectedL = false;

$output = '
<table class="w3-table-all w3-center">
<thead>
  <tr>
  <th style="width: 14%">
  Nom
  </th>
  <th style="width: 14%">
 Courriel
  </th>
    <th style="width: 14%">
    Numéro de commande
    </th>
    <th style="width: 14%">
    Prix total
    </th>
    <th style="width: 14%">
    Date de commande
   </th>
   <th style="width: 14%">
  Statut
  </th>
  <th style="width: 14%">
 Action
  </th>
  </tr>
</thead>
';
foreach ($result2 as $row) {
    $selectedA = false;
    $selectedE = false;
    $selectedL = false;

    if ($row["statut"] == "A") {
        $statut = "En attente";
        $selectedA = true;
    } else if ($row["statut"] == "E") {
        $statut = "En cours de livraison";
        $selectedE = true;
    } else {
        $statut = "Livré";
        $selectedL = true;
    }
   

    $output .= '

<tr class="w3-center">
<td> ' .
$row['prenom'] . " " .  $row['nom'] . '
</td>
<td>
' .
$row['email'] . '
</td>
    <td> ' .
        $row['id'] . '
    </td>
    <td>
    ' .
        $row['prixtotal'] . '$' . '
    </td>
    <td>
    ' .
        $row['datecommande'] . '
    </td>
    <td>
    <select class="w3-select w3-border w3-margin-bottom w3-round-large statutCommande">
    <option value="A" '; if($selectedA == true) {$output .= ' selected '; } $output .= ' >En attente</option>
    <option value="E" '; if($selectedE == true) { $output .= ' selected '; } $output .= '>En cours de livraison</option>
    <option value="L" '; if($selectedL == true)  {$output .= ' selected';} $output .= '>Livré</option>
   </select>
    </td>
    <td>
    <a id = "'.$row['id'].'" class="w3-button w3-blue-grey w3-round w3-margin-bottom update" href="#">
    <i class="fas fa-edit"></i>
  Modifier le statut
  </a>
    <a class="w3-button w3-grey w3-round" href="?page=commande_details&id='.$row['id'].'">
            <i class="fas fa-info-circle"></i>
          Détails de la commande
          </a>
          </td>
 </tr>
 ';

}
$output .= '</tbody> </table>';
echo $output;

}

$conn = null;
