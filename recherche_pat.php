<script src="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/js/ion.rangeSlider.min.js"></script>
<script src="js/produit.js"></script>



<div class="w3-row-padding w3-padding-64 w3-container">

<h1 class="w3-center">Rechercher une pâtisserie</h1>

    <div style="border:1px solid black" class="w3-col m3 ">
        <form id="form_recherche" class="w3-container w3-card-4" method="POST">
            <h2 class="w3-center">Filtre</h2>
            <p>
                <input name="noisette" id="noisette" class="w3-check" type="checkbox">
                <label>Noisette</label></p>
            <p>
                <input name="chocolat" id="chocolat" class="w3-check" type="checkbox">
                <label> Chocolat</label></p>
            <p>
                <input name="framboise" id="framboise" class="w3-check" type="checkbox">
                <label>Framboise</label></p>
            <p>
                <input name="marron" id="marron" class="w3-check" type="checkbox">
                <label>Marron</label></p>

            <p>Tranche de prix:</p>

            <input type="text" class="js-range-slider" name="prix" />

            <input type="text" style="margin-top:30px" id="nomProduit" name="nomProduit" class="w3-input w3-border" placeholder="Entrer le nom d'une pâtisserie" />

            <input id="submit" type="submit" value="Appliquer les filtres" class="w3-padding w3-margin-top w3-block w3-brown w3-margin-bottom" style="margin-right: auto; margin-left: auto;">
        </form>
    </div>

    <div class="w3-col m9" id="pat_data">

    </div>

</div>
