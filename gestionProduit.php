<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["id_user"])) {
    header("Location: index.php");
    die;
}
?>

<script src="js/gestionProduits.js" charset="utf-8"></script>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%;margin:auto;">

<h1 class="w3-center">Gestion de produits</h1>

<input id="recherchePat" style="width:30%" type="text" class="w3-left w3-input w3-border w3-round-large" placeholder="Nom de la pâtisserie">

<a onclick="document.getElementById('modalAddPat').style.display='block'" style="margin-bottom:5px" class=" w3-button w3-green w3-round w3-right" href="#"><i style="margin:5px" class="fas fa-plus"></i>Ajouter</a>

<div id="gestionProduit_data">

</div>
<div id="modalAddPat" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('modalAddPat').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright close" title="Close Modal">&times;</span>
        <h2>Ajouter une patisserie</h2>
      </div>

      <form id="ajoutPat_form" class="w3-container" method="post">
        <div class="w3-section">
          <label><b>Nom</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="text" placeholder="Entrez le nom de la pâtisserie"id="nom" name="nom">
          <label><b>Prix</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="number" step="0.01" min="1" max="100" placeholder="Entrer le prix de la pâtisserie" id="prix"name="prix">
          <label><b>Quantité</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="number" placeholder="Entrer la quantité de la pâtisserie"id="quantite" name="quantite">
          <label><b>Sorte</b></label>
          <select class="w3-select w3-border w3-margin-bottom w3-round-large" name="sorte">
             <option value="noisette">Noisette</option>
             <option value="chocolat">Chocolat</option>
             <option value="framboise">Framboise</option>
            <option value="marron">Marron</option>
            </select>
            <label><b>Détails</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="details" id="details" placeholder="Entrer les détails de la pâtisserie"></textarea>
            <label><b>Ingrédients</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="ingredients" id="ingredients" placeholder="Entrer les ingrédients de la pâtisserie"></textarea>
            <label><b>Allergènes</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="allergenes" id="allergenes" placeholder="Entrer les allergènes de la pâtisserie"></textarea>
            <label><b>Image</b></label>
            <input type="file" name="image" id="image"> <br>
            <label><b>Fichier PDF</b></label>
            <input type="file" name="pdf" id="pdf">
        </div>


      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('modalAddPat').style.display='none'" type="button" class="w3-button w3-red close">Annuler</button>
        <button class="w3-button  w3-green  w3-right" type="submit">Ajouter</button>
        </form>
      </div>

    </div>
  </div>
</div>

<div id="modalEditPat" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('modalEditPat').style.display='none'" class="w3-button w3-xlarge w3-hover-red w3-display-topright close" title="Close Modal">&times;</span>
        <h2>Modifier une patisserie</h2>
      </div>

      <form id="modifPat_form" class="w3-container" method="post">
        <div class="w3-section">
          <label><b>Nom</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="text" placeholder="Entrez le nom de la pâtisserie"id="nom2" name="nom2">
          <label><b>Prix</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="number" step="0.01" min="1" max="100" placeholder="Entrer le prix de la pâtisserie" id="prix2"name="prix2">
          <label><b>Quantité</b></label>
          <input class="w3-input w3-border w3-margin-bottom w3-round-large" type="number" placeholder="Entrer la quantité de la pâtisserie"id="quantite2" name="quantite2">
          <label><b>Sorte</b></label>
          <select class="w3-select w3-border w3-margin-bottom w3-round-large"id="sorte" name="sorte2">
             <option value="noisette">Noisette</option>
             <option value="chocolat">Chocolat</option>
             <option value="framboise">Framboise</option>
            <option value="marron">Marron</option>
            </select>
            <label><b>Détails</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="details2" id="details2" placeholder="Entrer les détails de la pâtisserie"></textarea>
            <label><b>Ingrédients</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="ingredients2" id="ingredients2" placeholder="Entrer les ingrédients de la pâtisserie"></textarea>
            <label><b>Allergènes</b></label>
            <textarea style="resize:none" class="w3-input w3-margin-bottom w3-border w3-round-large" name="allergenes2" id="allergenes2" placeholder="Entrer les allergènes de la pâtisserie"></textarea>
            <label><b>Statut</b></label>
          <select class="w3-select w3-border w3-margin-bottom w3-round-large" id="statut" name="statut">
             <option value="1">Actif</option>
             <option value="0">Inactif</option>
            </select>
            <label><b>Image</b></label>
            <input type="file" name="image2" id="image2"> <br>
            <label><b>Fichier PDF</b></label>
            <input type="file" name="pdf2" id="pdf2">
            <input type="hidden" id="patId" name="patId">
            <input type="hidden" id="ancienNom" name="ancienNom">
        </div>


      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button onclick="document.getElementById('modalEditPat').style.display='none'" type="button" class="w3-button w3-red close">Annuler</button>
        <button class="w3-button  w3-green  w3-right" type="submit">Modifier</button>
        </form>
      </div>

    </div>
  </div>
</div>
</div>
