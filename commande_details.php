
<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
  header("Location: index.php");
}

require "php/BD.inc.php";

if(isset($_GET["id"])){

  if($_SESSION["type"] == "A"){
    $sql = "SELECT * from commandes where id = :id";
    $query=$conn->prepare($sql);
    $query->execute(["id" => $_GET["id"]]);
  }else{
  $sql = "SELECT * from commandes where id = :id and id_user = :id_user";
$query=$conn->prepare($sql);
$query->execute(["id" => $_GET["id"],"id_user" => $_SESSION["id_user"]]);
}
$result = $query->fetch();

if($result["id"] != $_GET["id"] ){
    echo "<h1>Erreur 404</h1>";
}

  $sql = "SELECT * from adresseCommandes where id_commande = :id";
$query2=$conn->prepare($sql);
$query2->execute([":id" => $_GET["id"]]);
$result2 = $query2->fetchAll(PDO::FETCH_ASSOC);



}
else{
    echo "<h1>Erreur 404</h1>";
}
$conn = null;

if($result){

foreach ($result2 as $row) {?>

<script src="js/commandes.js" charset="utf-8"></script>

  <a class="w3-button w3-border w3-round w3-brown" href="<?php if($_SESSION["type"] == "A") echo "?page=commandes"; else echo "?page=commande";?>"><span class="fas fa-arrow-left"></span> Retour à la liste des commandes</a> 
  
  <h1 class="w3-center">Détails de la commande</h1>

    <div class="w3-container w3-card-4 w3-sand w3-text-brown w3-margin">

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-address-card"></i></div>
      <div class="w3-rest">
      <label>Adresse</label>
        <input class="w3-input w3-border" readonly type="text" value="<?php echo $row["address_line_1"];?>">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-address-card"></i></div>
      <div class="w3-rest">
      <label>Adresse 2</label>
        <input class="w3-input w3-border" readonly value="<?php if(isset($row["address_line_2"]))echo $row["address_line_2"];else echo "N/A"?>" type="text">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-city"></i></div>
      <div class="w3-rest">
      <label>Ville</label>
        <input class="w3-input w3-border" readonly value="<?php echo $row["ville"];?>"type="text">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fas fa-globe"></i></div>
      <div class="w3-rest">
      <label>Code de province</label>
        <input class="w3-input w3-border" readonly  value="<?php echo $row["province_code"] ;?>" type="text">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-mail-bulk"></i></div>
      <div class="w3-rest">
      <label>Code postal</label>
        <input class="w3-input w3-border" readonly  value="<?php echo $row["postal_code"] ;?>"type="text">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-globe"></i></div>
      <div class="w3-rest">
      <label>Code de pays</label>
        <input class="w3-input w3-border" readonly  value="<?php echo $row["country_code"] ;?>" type="text">
      </div>
    </div>
</div>
<?php }?>
    <div class="w3-margin" id="commande_detail_data">

    </div>
</div>
<?php }?>