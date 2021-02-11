$(document).ready(function () {
  fetch_data_commande();

  function fetch_data_commande() {
    var action = "fetch";
    $.ajax({
      url: "php/commandes.php",
      method: "POST",
      data: { action: action },
      success: function (data) {
        $("#commande_data").html(data);
      }
    });
  }


  var url_string = window.location.href;
  var url = new URL(url_string);
  var id = url.searchParams.get("id");

  fetch_data_commande_details();

  function fetch_data_commande_details() {
    var action = "fetch_details";
    $.ajax({
      url: "php/commandes.php",
      method: "POST",
      data: { action: action, id_commande: id },
      success: function (data) {
        $("#commande_detail_data").html(data);
      }
    });
  }

  $("#periode").change(function () {
    statut = $(this).val();
    var action = "recherche";

    if (statut != "") {
      $.ajax({
        type: "post",
        url: "php/commandes.php",
        data: { action: action, statut: statut },
        success: function (data) {
          $("#commandes_data").html(data);
        }
      });
    } else {
      fetch_commandes_data();
    }

  });

  fetch_commandes_data();

  function fetch_commandes_data() {
    var action = "fetchs";
    $.ajax({
      url: "php/commandes.php",
      method: "POST",
      data: { action: action },
      success: function (data) {
        $("#commandes_data").html(data);
      }
    });
  }

  $(document).on("click", ".update", function () {
    var idCommande = $(this).attr("id");
    var action = "modifier";
    var statut = $(event.target)
      .closest("tr")
      .find(".statutCommande")
      .val();

    $.ajax({
      type: "post",
      url: "php/commandes.php",
      data: { action: action, idCommande: idCommande, statut: statut },
      success: function (data) {
        alert(data);
      }
    });

  });

});
