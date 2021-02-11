<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])|| $_SESSION["type"] != "A") {
    header("Location: index.php");
}
?>

<script src="js/commandes.js" charset="utf-8"></script>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

<h1 class="w3-center">Liste des commandes</h1>

<select id="periode" style="inline-block" class=" w3-border w3-margin-bottom w3-round-large ">
    <option value="">Tous les commandes</option>
     <option value="jour">Dans la dernière journée</option>
     <option value="mois">Dans le dernier mois</option>
     <option value="annee">Dans la dernière année</option>
 </select>

<div id="commandes_data">

</div>

</div>
