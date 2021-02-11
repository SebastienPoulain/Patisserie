<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
}
?>

<script src="js/commandes.js" charset="utf-8"></script>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

<h1 class="w3-center">Mes commandes</h1>

<div id="commande_data">

</div>

</div>
