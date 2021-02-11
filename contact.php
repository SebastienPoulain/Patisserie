<div class="w3-row-padding w3-padding-64 w3-container" style="width:80%; margin: auto;">


  <div id="alert" style="display:none" class="w3-center w3-panel w3-red">
    <strong id="erreur"></strong>
  </div>
  <div id="success" style="display:none" class="w3-center w3-panel w3-green">
    <strong id="result"></strong>
  </div>

  <form id="contactForm" method="post" class="w3-container w3-card-4 w3-sand w3-text-brown w3-margin">
    <h2 class="w3-center">Contactez-nous</h2>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-user"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="nom" name="nom" type="text" placeholder="Nom">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-envelope"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="Cemail" name="email" type="text" placeholder="Email">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fas fa-pencil-alt"></i></div>
      <div class="w3-rest">
        <input class="w3-input w3-border" id="sujet" name="sujet" type="text" placeholder="Sujet">
      </div>
    </div>

    <div class="w3-row w3-section">
      <div class="w3-col" style="width:50px"><i class="w3-xxlarge fa fa-comments"></i></div>
      <div class="w3-rest">
        <textarea class="w3-input w3-border" style="resize:none" rows="5" id="message" name="message" placeholder="Message"></textarea>
      </div>
    </div>

    <input type="submit" value="Envoyer" class="w3-button w3-block w3-section w3-brown w3-ripple w3-padding">

  </form>
</div>

<script>
  $(document).ready(function() {
    $("#contactForm").submit(function() {
      var em = $("#Cemail").val();
      var nm = $("#nom").val();
      var sub = $("#sujet").val();
      var com = $("#message").val();
      var re = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var dataString = 'em1=' + em + '&nm1=' + nm + '&sub1=' + sub + '&com1=' + com;
      if (em == '' || sub == '' || com == '' || nm == '') {
        $("#alert").css("display", "block");
        $("#erreur").html("Vous devez remplir tous les champs");
        $("#alert").show();
      } else if (!re.test(em)) {
        $("#alert").css("display", "block");
        $("#erreur").html("Vous devez entrer un email valide");
        $("#Cemail").focus();
      } else {
        $.ajax({
          type: "POST",
          url: "validationContactForm.php",
          data: dataString,
          success: function(result) {
            $("#Cemail").val("");
            $("#nom").val("");
            $("#sujet").val("");
            $("#message").val("");
            $("#alert").hide();
            $("#success").show();
            $("#result").html(result);
            setTimeout(function() {
              $("#success").hide();
            }, 5000);
          }
        });
      }
      return false;
    });
  });
</script>
