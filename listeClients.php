<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
    die;
}
?>

<script src="js/listeClients.js" charset="utf-8"></script>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

<h1 class="w3-center">Liste des clients</h1>

<input id="rechercheClient" style="width:30%" type="text" class="w3-left w3-input w3-border w3-round-large w3-margin-bottom" placeholder="Nom du client">

<div id="listeClients_data">

</div>

</div>
