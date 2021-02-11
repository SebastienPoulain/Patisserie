
<script src="js/slick.js" charset="utf-8"></script>

<!-- Header -->
<header id="header" class="w3-container w3-sand w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo" style="font-weight:bold;">Délices et Merveilles</h1>
  <p class="w3-xlarge">Pâtisseries haut de gamme</p>
  <!-- <button class="w3-button w3-black w3-padding-large w3-large w3-margin-top">Get Started</button> -->
</header>

<?php require "php/BD.inc.php";?>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">


  <div style="width:100%;" class="w3-twothird">

    <div class="slider w3-container">
      <div class="slide-track">

<?php $statut = "1";
$sql = ("SELECT * FROM produits WHERE statut = :statut order by id DESC LIMIT 10");
$stmt = $conn->prepare($sql);
$stmt->execute(array(':statut' => $statut));

foreach ($stmt as $row) {?>

  <div style="cursor:pointer" class="w3-card w3-sand w3-padding-16 w3-round-xlarge w3-show-inline-block w3-margin-left w3-margin-bottom">
    <div class=" w3-container w3-center ">
      <a href="?page=patisserie&id=<?=$row["id"]?>"><img class="w3-image" src="<?=$row["image"]?>" style="max-width: 210px; max-height: 210px; margin: auto;" alt="<?=$row["nom"]?>"></a>
      <a href="?page=patisserie&id=<?=$row["id"]?>">
        <h4><?=$row["nom"]?></h4>
      </a>
      <h5 class="w3-text-grey">$<?=$row["prix"]?></h5>
    </div>
  </div>

<?php }
$conn = null;?>

      </div>
    </div>

    <button class="slick-prev w3-button w3-round w3-brown" id="prevBT" style="font-size: 20px;"><</button>
    <button class="slick-next w3-button w3-round w3-brown" id="nextBT" style="float: right;font-size: 20px;">></button>

  </div>
</div>

<!-- Second Grid -->
<div id="propos" class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-third w3-center">
      <i class="fas fa-coffee w3-padding-64 w3-text-brown w3-margin-right"></i>
    </div>

    <div class="w3-twothird">
      <h1>À propos de nous</h1>
      <h5 class="w3-padding-32">NOS PÂTISSERIE SONT LES MEILLEURS ANTIDÉPRESSEURS DU MONDE. ILS DEVRAIENT ÊTRE REMBOURSÉS PAR L’ASSURANCE MALADIE.
Chez Délices et Merveilles, les pâtissiers sont des gourmands endurcis qui ont les valeurs à la bonne place : beurre, crème 35%, chocolat véritable, fruits frais, sirop d’érable. Pas de sirop de poteau. Du vrai fun sucré. C’est pourquoi nous vous proposons des desserts riches en émotions et, bien franchement…</h5>

      <p class="w3-text-grey">Toutes nos recettes utilisent des ingrédients simples et faciles à trouver dans vos cuisines. En fait, nous confectionnons chacune de nos patisseries en imaginant l’offrir à la personne que nous aimons le plus au monde.
Ça dit tout!

La prochaine fois que vous aurez la chance de vous gâter avec une patisserie de la Pâtisserie Délices et Merveilles, laissez-vous aller! Faites une petite danse de bonheur, versez une larme de joie! Ne pensez pas aux calories, oubliez votre régime! Et surtout, amusez-vous avec ceux que vous aimez, sans retenue!</p>
      </div>
    </div>
  </div>

  <div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Citation de la journée : Achetez nos pâtisseries</h1>
  </div>
