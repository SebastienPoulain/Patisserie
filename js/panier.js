$(document).ready(function() {

  function pullArticles() {
    var table = $("table");
    var tbody = table.find("tbody");
    $("#prixArticles").text("0");

    $.ajax({
      url: "php/panier.php",
      type: "POST",
      dataType: "html",
      success: function(data) {
        if (data == "empty") {
          //alert("empty");
        } else if (data == "no_login") {
          //alert("not logged in");
        } else {
          tbody.html(data);
          $(".prixT").each(function(index, el) {
            $("#prixArticles").text((parseFloat($("#prixArticles").text()) + parseFloat($(el).text())).toFixed(2));
          });
          $("#TPS").text((parseFloat($("#prixArticles").text()) * 5 / 100).toFixed(2));
          $("#TVQ").text((parseFloat($("#prixArticles").text()) * 9.975 / 100).toFixed(2));
          $("#prixTotal").text((parseFloat($("#prixArticles").text()) + parseFloat($("#TPS").text()) + parseFloat($("#TVQ").text())).toFixed(2));

          var articles = [];
          var quantites = [];

          for (var i = 0; i < $(tbody).children('tr').length; i++) {

            var tr = $(tbody).children('tr')[i];
            var tdArticle = $(tr).children('td')[0];
            var tdQte = $(tr).children('td')[1];
            var inputQte = $(tdQte).find('.quantite');

            articles.push($(tdArticle).attr('id'));
            quantites.push($(inputQte).val());
          }

          $.ajax({
            url: 'php/setpaniervalues.php',
            type: 'POST',
            data: {
              articles: articles,
              quantites: quantites,
              prixT: $("#prixTotal").text()
            },
            success: function(data) {
              var isConnected;

              $.ajax({
                url: 'php/isconnected.php',
                type: 'POST',
                success: function(data) {
                  if (data == "-1") {
                    isConnected = false;
                  } else {
                    isConnected = true;
                  }
                }
              }).done(function() {


                if (isConnected) {
                  $.ajax({
                    url: 'php/getprixt.php',
                    type: 'POST',
                    success: function(rep) {
                      paypal.Buttons({
                        createOrder: function(data, actions) {

                          return actions.order.create({
                            purchase_units: [{
                              amount: {
                                value: rep
                              }
                            }]
                          });
                        },
                        onApprove: function(data, actions) {
                          return actions.order.capture().then(function(details) {
                            if (details.status == "COMPLETED") {

                              $.ajax({
                                url: 'php/buy.php',
                                type: 'POST',
                                data: {
                                  id: details.id,
                                  address_line_1: details.purchase_units[0].shipping.address.address_line_1,
                                  address_line_2: details.purchase_units[0].shipping.address.address_line_2,
                                  ville: details.purchase_units[0].shipping.address.admin_area_2,
                                  province: details.purchase_units[0].shipping.address.admin_area_1,
                                  postal_code: details.purchase_units[0].shipping.address.postal_code,
                                  country_code: details.purchase_units[0].shipping.address.country_code
                                },
                                success: function(data) {
                                  if (data.includes("success")) {
                                    alert("Votre commande a bien été prise en compte");
                                    location.reload();
                                  } else {
                                    alert("Erreur, votre commande n'a pas été prise en compte");
                                    location.reload();
                                  }
                                }
                              });

                            }
                          });
                        }
                      }).render('#paypal-button-container');
                    }
                  });

                } else {
                  var bt = $('<a class="w3-btn w3-block w3-brown w3-margin-bottom">Connexion requise pour commander</a>');

                  $(bt).click(function(event) {
                    $(".cd-panel").addClass('cd-panel--is-visible');
                  });

                  $('#paypal-button-container').append(bt);
                }

              });

            }
          });

        }
      }
    });
  }

  pullArticles();

  $(document).on('click', '.moins', function(event) {
    var nb = $(this).siblings('.quantite').val();
    if (+nb > 1) {
      nb = +nb - 1;
      $(this).siblings('.quantite').val(nb);
    } else if (+nb <= 1) {
      nb = 1;
      $(this).siblings('.quantite').val(nb);
    }
  });

  $(document).on('click', '.plus', function(event) {
    var nb = $(this).siblings('.quantite').val();
    var qtemax = $(this).siblings('.quantite').attr("max");
    if (+nb < +qtemax) {
      nb = +nb + 1;
      $(this).siblings('.quantite').val(nb);
    }
    if (+nb >= +qtemax) {
      nb = +qtemax;
      $(this).siblings('.quantite').val(nb);
    }
  });

  $(document).on('click', 'button[name=delete]', function(event) {

    if (confirm("Êtes-vous certain de vouloir supprimer cette pâtisserie de votre panier ?")) {
      var id_produit = $(event.target).attr('id');

      $.ajax({
        url: 'php/delprodpanier.php',
        type: 'POST',
        data: {
          id_produit: id_produit
        },
        success: function(data) {
          $.ajax({
              url: 'php/quantitepanier.php',
              type: 'POST'
            })
            .done(function() {
              location.reload();
            });

        }
      });
    }
  });

  $("#setQte").click(function(event) {
    var table = $("table");
    var tbody = table.find("tbody");
    var articles = [];
    var quantites = [];
    var stop = false;

    for (var i = 0; i < $(tbody).children('tr').length; i++) {

      var tr = $(tbody).children('tr')[i];
      var tdArticle = $(tr).children('td')[0];
      var tdQte = $(tr).children('td')[1];
      var inputQte = $(tdQte).find('.quantite');

      articles.push($(tdArticle).attr('id'));
      quantites.push($(inputQte).val());
    }

    for (var i = 0; i < quantites.length; i++) {
      if (!quantites[i].match(/^\d+$/) || quantites[i] == 0 || quantites[i] > 99) {
        alert("Une quantité entrée est invalide");
        stop = true;
      }
    }

    if (!stop) {
      $.ajax({
        url: 'php/setnewqte.php',
        type: 'POST',
        data: {
          articles: articles,
          quantites: quantites
        },
        success: function(data) {
          if (data == "success") {
            $.ajax({
                url: 'php/quantitepanier.php',
                type: 'POST'
              })
              .done(function() {
                location.reload();
              })
          } else {
            alert("Une erreur s'est produite");
          }
        }
      });
    }


  });


});
