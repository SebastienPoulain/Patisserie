function addtocart(sender){
  var bt = $(sender);
  var qtemax = $(bt).attr('data-qtemax');
  var id = $(bt).attr('id');

  if (qtemax <= 0){
    alert("Ce produit n'est plus disponible");
  } else {
    $.ajax({
      url: 'php/addtocart.php',
      type: 'POST',
      data: {id: id, qte: 1},
      success: function(data){
        if (data == "success") {
          alert("Article ajouté au panier");
          $.ajax({
            url: 'php/quantitepanier.php',
            type: 'POST'
          }).done(function(){
            $("#cartCountContainer").load(location.href + " #cartCount");
          });
        } else {
          alert("Erreur");
        }
      }
    });

  }
}

$(document).ready(function() {
  min = 10;
  max = 100;

  fetch_data();

  function fetch_data() {
    var action = "fetch";
    $.ajax({
      url: "php/produit.php",
      method: "POST",
      data: { action: action },
      success: function(data) {
        $("#pat_data").html(data);
      }
    });
  }

  $(".js-range-slider").ionRangeSlider({
    type: "double",
    min: 10,
    max: 100,
    from: 10,
    to: 100,
    grid: true,
    skin: "square",
    onChange: function(data) {
      min = data.from;
      max = data.to;
    }
  });

  $("#form_recherche").submit(function(event) {
    event.preventDefault();
    var action = "recherche";
    var noisette = "";
    var chocolat = "";
    var framboise = "";
    var marron = "";

    var txt = $("#nomProduit").val();

    if ($("#noisette").prop("checked")) {
      noisette = "noisette";
    }
    if ($("#chocolat").prop("checked")) {
      chocolat = "chocolat";
    }
    if ($("#framboise").prop("checked")) {
      framboise = "framboise";
    }
    if ($("#marron").prop("checked")) {
      marron = "marron";
    }
    var sorte = [noisette, chocolat, framboise, marron];
    $.ajax({
      url: "php/produit.php",
      method: "POST",
      data: { action: action, min: min, max: max, sorte: sorte, txt: txt },
      success: function(data) {
        $("#pat_data").html(data);
      }
    });
    return false;
  });
});
