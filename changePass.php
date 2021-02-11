<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
    die;
}
?>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

  <form id="mdpForm" method="post" class="w3-container w3-card-4 w3-sand w3-text-brown w3-margin">
    <h2 class="w3-center">Changement de mot de passe</h2>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-unlock"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="apass" name="apass" type="password" placeholder="Ancien mot de passe">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-unlock"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="pass" name="pass" type="password" placeholder="Nouveau mot de passe">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-unlock"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="cpass" name="cpass" type="password" placeholder="Confirmation nouveau mot de passe">
      </div>
    </div>

    <input  type="submit" value="Envoyer" class="w3-button w3-block w3-section w3-brown w3-ripple w3-padding">

  </form>
</div>
</div>
