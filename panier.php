<script src="js/panier.js" charset="utf-8"></script>

<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%; margin: auto;">

  <h1 style="text-align: center">Vérifier et commander</h1>

  <div class="w3-row">

    <div class="w3-col m8">
      <table class="w3-table-all w3-centered">
        <thead>
          <th class="w3-large w3-brown">Article</th>
          <th class="w3-large w3-brown">Quantité</th>
          <th class="w3-large w3-brown">Prix unitaire</th>
          <th class="w3-large w3-brown">Prix total</th>
          <th class="w3-large w3-brown">Action</th>
        </thead>
        <tbody>

        </tbody>
      </table>
      <input id="setQte" class="w3-btn w3-brown w3-right" type="button" value="Appliquer les nouvelles quantités">
    </div>

    <div class="w3-col m4">
      <div class="w3-card-4">

        <header class="w3-container w3-brown">
          <h2>Commander</h2>
        </header>

        <div class="w3-container w3-sand">
          <p>Articles: <span id="prixArticles">0</span>$</p>
          <p>TPS: <span id="TPS">0</span>$</p>
          <p>TVQ: <span id="TVQ">0</span>$</p>
          <p>Prix total: <span id="prixTotal" style="font-weight: bold;">0</span>$</p>
        </div>

        <footer class="w3-container w3-sand">
          <!-- <input class="w3-btn w3-brown w3-block w3-margin-bottom w3-margin-top" type="button" value="Commander"> -->
          <div id="paypal-button-container" style="position: relative; z-index: 1;"></div>
        </footer>

      </div>
    </div>


  </div>

</div>
