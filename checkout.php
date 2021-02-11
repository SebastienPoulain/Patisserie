<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
    die;
}?>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

  <form id="profilForm" method="post" class="w3-container w3-card-4 w3-sand w3-text-brown w3-margin">
    <h2 class="w3-center">Profil</h2>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-envelope"></i></div>
      <div class="w3-rest">
      <label>Email</label>
        <input class="w3-input w3-border" readonly type="email" value="<?php echo $_SESSION["email"];?>">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-user"></i></div>
      <div class="w3-rest">
      <label for="prenom">Prénom</label>
        <input class="w3-input w3-border" readonly value="<?php echo $_SESSION["prenom"];?>" id="prenom" name="prenom" type="text" placeholder="Entrer votre prénom">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-user"></i></div>
      <div class="w3-rest">
      <label for="nom">Nom</label>
        <input class="w3-input w3-border" readonly value="<?php echo $_SESSION["nom"];?>" id="nom" name="nom" type="text" placeholder="Entrer votre nom">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-sort-numeric-up"></i></div>
      <div class="w3-rest">
      <label for="numCivic">Numéro civic</label>
        <input class="w3-input w3-border" id="numCivic" value="<?php if (isset($_SESSION["numcivic"])) {
    echo $_SESSION["numcivic"];
}?>" name="numCivic" type="text" placeholder="Entrer votre numéro civic">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-road"></i></div>
      <div class="w3-rest">
      <label for="rue">Rue</label>
        <input class="w3-input w3-border" value="<?php if (isset($_SESSION["rue"])) {
    echo $_SESSION["rue"];
}?>" id="rue" name="rue" type="text" placeholder="Entrer le nom de votre rue">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-city"></i></div>
      <div class="w3-rest">
      <label for="ville">Ville</label>
        <input class="w3-input w3-border" value="<?php if (isset($_SESSION["ville"])) {
    echo $_SESSION["ville"];
}?>" id="ville" name="ville" type="text" placeholder="Entrer votre ville">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-globe"></i></div>
      <div class="w3-rest">
      <label for="pays">Pays</label>
        <input class="w3-input w3-border" value="<?php if (isset($_SESSION["pays"])) {
    echo $_SESSION["pays"];
}?>" id="pays" name="pays" type="text" placeholder="Entrer votre pays">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-mail-bulk"></i></div>
      <div class="w3-rest">
      <label for="codePostal">Code Postal</label>
        <input class="w3-input w3-border" id="codePostal" value="<?php if (isset($_SESSION["codepostal"])) {
    echo $_SESSION["codepostal"];
}?>" name="codePostal" type="text" placeholder="Entrer votre code postal">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-phone"></i></div>
      <div class="w3-rest">
      <label for="tel">Numéro de téléphone</label>
        <input class="w3-input w3-border" id="tel" value="<?php if (isset($_SESSION["tel"])) {
    echo $_SESSION["tel"];
}?>" name="tel"  type="text" placeholder="Entrer votre numéro de téléphone">
      </div>
    </div>

    

  </form>
</div>
</div>
