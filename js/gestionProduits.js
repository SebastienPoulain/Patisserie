$(document).ready(function() {
  fetch_data();

  function fetch_data() {
    var action = "fetch";
    $.ajax({
      url: "php/gestionProduits.php",
      method: "POST",
      data: { action: action },
      success: function(data) {
        $("#gestionProduit_data").html(data);
      }
    });
  }

  $(".close").click(function() {
    $("#ajoutPat_form")[0].reset();
    $("#modifPat_form")[0].reset();
  });

  $("#ajoutPat_form").submit(function(event) {
    event.preventDefault();

    if ($("#nom").val() == "") {
      alert("Vous devez inscrire un nom de pâtisserie");
      return false;
    }

    if ($("#prix").val() == "") {
      alert("Vous devez inscrire un prix");
      return false;
    }

    if ($("#quantite").val() == "") {
      alert("Vous devez inscrire une quantité");
      return false;
    }

    if ($("#details").val() == "") {
      alert("Vous devez inscrire les détails de la pâtisserie");
      return false;
    }

    if ($("#ingredients").val() == "") {
      alert("Vous devez inscrire les ingrédients de la pâtisserie");
      return false;
    }

    if ($("#allergenes").val() == "") {
      alert("Vous devez inscrire les allergènes de la pâtisserie");
      return false;
    }

    if ($("#image").val() == "") {
      alert("Vous devez choisir une image");
      return false;
    } else {
      var extension = $("#image")
        .val()
        .split(".")
        .pop()
        .toLowerCase();
      if (jQuery.inArray(extension, ["gif", "png", "jpg", "jpeg"]) == -1) {
        alert("Type de fichier non valide pour une image");
        $("#image").val("");
        return false;
      }
    }

    if ($("#pdf").val() == "") {
      alert(
        "Vous devez inclure un fichier pdf avec la description détaillée du produit"
      );

      return false;
    } else {
      var extension = $("#pdf")
        .val()
        .split(".")
        .pop()
        .toLowerCase();
      if (jQuery.inArray(extension, ["pdf"]) == -1) {
        alert("Vous devez choisir un fichier de type PDF");
        $("#pdf").val("");
        return false;
      }
    }

    var formData = new FormData($("form#ajoutPat_form")[0]);
    formData.append("action", "insert");
    $.ajax({
      url: "php/gestionProduits.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data == "La patisserie existe déjà, choisissez un autre nom") {
          alert(data);
        } else {
          alert(data);
          fetch_data();
          $("#ajoutPat_form")[0].reset();
          $("#modalAddPat").hide();
        }
      }
    });
  });

  $("#modifPat_form").submit(function(event) {
    event.preventDefault();

    if ($("#nom2").val() == "") {
      alert("Vous devez inscrire un nom de pâtisserie");
      return false;
    }

    if ($("#prix2").val() == "") {
      alert("Vous devez inscrire un prix");
      return false;
    }

    if ($("#quantite2").val() == "") {
      alert("Vous devez inscrire une quantité");
      return false;
    }

    if ($("#details2").val() == "") {
      alert("Vous devez inscrire les détails de la pâtisserie");
      return false;
    }

    if ($("#ingredients2").val() == "") {
      alert("Vous devez inscrire les ingrédients de la pâtisserie");
      return false;
    }

    if ($("#allergenes2").val() == "") {
      alert("Vous devez inscrire les allergènes de la pâtisserie");
      return false;
    }

    var formData = new FormData($("form#modifPat_form")[0]);
    formData.append("action", "update");
    $.ajax({
      url: "php/gestionProduits.php",
      method: "POST",
      data: formData,
      contentType: false,
      processData: false,
      success: function(data) {
        if (data == "La patisserie existe déjà, choisissez un autre nom") {
          alert(data);
        } else {
          alert(data);
          fetch_data();
          $("#modifPat_form")[0].reset();
          $("#modalEditPat").hide();
        }
      }
    });
  });

  $("#recherchePat").keyup(function() {
    var txt = $(this).val();
    var action = "recherche";
    if (txt != "") {
      $.ajax({
        type: "post",
        url: "php/gestionProduits.php",
        data: { txt: txt, action: action },
        dataType: "text",
        success: function(data) {
          $("#gestionProduit_data").html(data);
        }
      });
    } else {
      fetch_data();
    }
  });

  $(document).on("click", ".update", function() {
    $("#modalEditPat").show();
    $("#sorte option:selected").removeAttr("selected", "selected");
    var allergenes = $(event.target)
      .closest("tr")
      .find(".allergene")
      .text();
    var nom = $(event.target)
      .closest("tr")
      .find(".nom")
      .text();
    var prix = $(event.target)
      .closest("tr")
      .find(".prix")
      .text();
    var quantite = $(event.target)
      .closest("tr")
      .find(".quantite")
      .text();
    var sorte = $(event.target)
      .closest("tr")
      .find(".sorte")
      .text();
    var details = $(event.target)
      .closest("tr")
      .find(".details")
      .text();
    var ingredients = $(event.target)
      .closest("tr")
      .find(".ingredients")
      .text();

    var stat = $(event.target)
      .closest("tr")
      .find("#typeStat")
      .hasClass("w3-red");

    if (!stat) {
      $("#statut option[value='0']").removeAttr("selected");
      $("#statut option[value='1']").attr("selected", "selected");
    } else if (stat) {
      $("#statut option[value='1']").removeAttr("selected");
      $("#statut option[value='0']").attr("selected", "selected");
    }

    $("#quantite2").val($.trim(quantite));
    $("#patId").val($(this).attr("id"));
    $("#prix2").val($.trim(prix));
    $("#nom2").val($.trim(nom));
    $("#details2").val($.trim(details));
    $("#ingredients2").val($.trim(ingredients));
    $("#allergenes2").val($.trim(allergenes));

    $("#ancienNom").val($("#nom2").val());

    if ($.trim(sorte) == "marron") {
      $("select option[value='marron']").attr("selected", "selected");
    } else if ($.trim(sorte) == "chocolat") {
      $("select option[value='chocolat']").attr("selected", "selected");
    } else if ($.trim(sorte) == "framboise") {
      $("select option[value='framboise']").attr("selected", "selected");
    } else if ($.trim(sorte) == "noisette") {
      $("select option[value='noisette']").attr("selected", "selected");
    }
  });

  $(document).on("click", ".delete", function() {
    var produit_id = $(this).attr("id");

    var action = "delete";
    if (confirm("Êtes-vous certain de vouloir supprimer ce produit ?")) {
      $.ajax({
        url: "php/gestionProduits.php",
        method: "POST",
        data: { produit_id: produit_id, action: action },
        success: function(data) {
          alert(data);
          fetch_data();
        }
      });
    }
  });
});
