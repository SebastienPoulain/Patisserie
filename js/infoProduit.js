function infoPat(evt, info) {
  var i, x, tablinks;
  x = document.getElementsByClassName("infoPath");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  tablinks = document.getElementsByClassName("tablink");
  for (i = 0; i < x.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(
      " w3-border-brown",
      ""
    );
  }
  document.getElementById(info).style.display = "block";
  evt.currentTarget.firstElementChild.className += " w3-border-brown";
}

$(document).ready(function() {
  var url_string = window.location.href;
  var url = new URL(url_string);
  var id = url.searchParams.get("id");

  $.ajax({
    type: "post",
    url: "php/infoProduit.php",
    data: {
      id: id
    },
    success: function(data) {
      $("#infoPats").html(data);

      var qtemax = $("#quantite").attr("max");

      $("#submit").click(function(event) {
        var qte = $("#quantite").val();

        if (!qte.match(/^\d+$/)) {
          alert("La quantité est incorrecte");
          event.preventDefault();
          event.stopPropagation();
        } else if (+qte > +qtemax) {
          alert("La quantité dépasse la quantité maximale disponible");
          event.preventDefault();
          event.stopPropagation();
        } else {
          $.ajax({
            url: "php/addtocart.php",
            type: "POST",
            data: {
              qte: qte,
              id: id
            },
            success: function(data) {
              if (data == "success") {
                alert("Article ajouté au panier");
                $.ajax({
                  url: "php/quantitepanier.php",
                  type: "POST"
                }).done(function() {
                  $("#cartCountContainer").load(location.href + " #cartCount");
                });
              } else {
                alert("Erreur");
              }
            }
          });
        }
      });

      $(document).on("click", "#moins", function() {
        var nb = $("#quantite").val();
        if (+nb > 1) {
          nb = +nb - 1;
          $("#quantite").val(nb);
        } else if (+nb <= 1) {
          nb = 1;
          $("#quantite").val(nb);
        }
      });

      $(document).on("click", "#plus", function() {
        var nb = $("#quantite").val();
        if (+nb < +qtemax) {
          nb = +nb + 1;
          $("#quantite").val(nb);
        }
        if (+nb >= +qtemax) {
          nb = +qtemax;
          $("#quantite").val(nb);
        }
      });
    }
  });
});
