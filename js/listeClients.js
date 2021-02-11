$(document).ready(function() {
  fetch_data();

  function fetch_data() {
    var action = "fetch";
    $.ajax({
      url: "php/listeClients.php",
      method: "POST",
      data: { action: action },
      success: function(data) {
        $("#listeClients_data").html(data);
      }
    });
  }

  $("#rechercheClient").keyup(function() {
    var txt = $(this).val();
    var action = "recherche";
    if (txt != "") {
      $.ajax({
        type: "post",
        url: "php/listeClients.php",
        data: { txt: txt, action: action },
        dataType: "text",
        success: function(data) {
          $("#listeClients_data").html(data);
        }
      });
    } else {
      fetch_data();
    }
  });
});
