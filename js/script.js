function afficherMenuP() {
  var x = document.getElementById("menuP");
  if (x.className.indexOf("w3-show") == -1) {
    x.className += " w3-show";
  } else {
    x.className = x.className.replace(" w3-show", "");
  }
}

$(document).ready(function() {
  $("button").removeClass("ui-btn ui-shadow ui-corner-all");

  $("#accueilP").click(function() {
    afficherMenuP();
  });
  $("#proposP").click(function() {
    afficherMenuP();
  });

  $(function($) {
    let url = window.location.href;
    $("#menu a").each(function() {
      if (this.href === url) {
        $(this).addClass("w3-white");
      }
    });
  });

  $("#form_login").submit(function(event) {
    var email = $.trim($("#email").val());
    var password = $("#password").val();

    $.ajax({
      url: "php/login.php",
      type: "POST",
      data: {
        email: email,
        password: password
      },
      success: function(data) {
        if (data == "success") {
          $("#confirmTitle").text("Succès");
          $("#confirmText").text("Connexion réussie");
          document.getElementById("logout-container").style.display = "block";
        } else if (data == "error_empty_field") {
          $("#login_error")
            .find("p")
            .text("Veuillez remplir tous les champs");
          $("#login_error").css("visibility", "visible");

          setTimeout(function() {
            $("#login_error").css("visibility", "hidden");
          }, 5000);
        } else if (data == "error_user_not_found") {
          $("#login_error")
            .find("p")
            .text("Email ou mot de passe invalide");
          $("#login_error").css("visibility", "visible");

          setTimeout(function() {
            $("#login_error").css("visibility", "hidden");
          }, 5000);
        }
      }
    });
    return false;
  });

  $("#form_register").submit(function(event) {
    var nom = $.trim($("#regNom").val());
    var prenom = $.trim($("#regPrenom").val());
    var email = $.trim($("#regEmail").val());
    var pass1 = $("#regPass1").val();
    var pass2 = $("#regPass2").val();
    var type = "U";

    if (nom != "" && prenom != "" && email != "" && pass1 == pass2) {
      $.ajax({
        url: "php/register.php",
        type: "POST",
        data: {
          type: type,
          nom: nom,
          prenom: prenom,
          email: email,
          password: pass1
        },
        success: function(data) {
          if (data == "success") {
            alert("Compte créé");
            $("#register-container").hide();
            $("#form_register")[0].reset();
          } else if (data == "error_user_exists") {
            alert("Un compte a déjà été créé avec cette adresse Email");
          } else {
            alert("Erreur lors de la création du compte");
          }
        }
      });
    } else if (
      nom == "" ||
      prenom == "" ||
      email == "" ||
      $.trim(pass1) == "" ||
      $.trim(pass2) == ""
    ) {
      alert("Veuillez remplir tous les champs");
    } else if (pass1 != pass2) alert("Les mots de passe ne correspondent pas");

    return false;
  });

  $("#form_registerAdmin").submit(function(event) {
    var nom = $.trim($("#regAdminNom").val());
    var prenom = $.trim($("#regAdminPrenom").val());
    var email = $.trim($("#regAdminEmail").val());
    var pass1 = $("#regAdminPass1").val();
    var pass2 = $("#regAdminPass2").val();
    var type = "A";

    if (nom != "" && prenom != "" && email != "" && pass1 == pass2) {
      $.ajax({
        url: "php/register.php",
        type: "POST",
        data: {
          type: type,
          nom: nom,
          prenom: prenom,
          email: email,
          password: pass1
        },
        success: function(data) {
          if (data == "success") {
            alert("Compte créé");
            $("#registerAdmin-container").hide();
            $("#form_registerAdmin")[0].reset();
          } else if (data == "error_user_exists") {
            alert("Un compte a déjà été créé avec cette adresse Email");
          } else {
            alert("Erreur lors de la création du compte");
          }
        }
      });
    } else if (
      nom == "" ||
      prenom == "" ||
      email == "" ||
      $.trim(pass1) == "" ||
      $.trim(pass2) == ""
    ) {
      alert("Veuillez remplir tous les champs");
    } else if (pass1 != pass2) alert("Les mots de passe ne correspondent pas");

    return false;
  });

  $("#logout").click(function(event) {
    $("#confirmTitle").text("Succès");
    $("#confirmText").text("Déconnexion réussie");
    $.ajax({
      url: "php/logout.php",
      type: "POST"
    });
  });

  $("#logoutConfirm").click(function(event) {
    $.ajax({
      url: "php/quantitepanier.php",
      type: "POST"
    }).done(function() {
      location.reload();
    });
  });

  $("#forgot_link").click(function(e) {
    e.preventDefault();
    $("#forgot-container").show();
  });

  $("#form_forgot").submit(function(e) {
    e.preventDefault();

    var email = $("#forgotEmail").val();

    if (email == "") {
      alert("Vous devez inscrire votre adresse courriel");
      return false;
    }

    $.ajax({
      type: "post",
      url: "php/forgot.php",
      data: { email: email },
      success: function(data) {
        alert(data);
        if (
          data == "Un mot de passe temporaire vous a été envoyé par courriel"
        ) {
          $("#forgot-container").hide();
          $("#form_forgot")[0].reset();
        }
      }
    });
  });

  $("#mdpForm").submit(function(e) {
    e.preventDefault();

    var apass = $("#apass").val();
    var pass = $("#pass").val();

    if (apass == "") {
      alert("Vous devez inscrire votre ancien mot de passe");
      return false;
    }

    if (pass == "") {
      alert("Vous devez inscrire un nouveau mot de passe");
      return false;
    }

    if ($("#cpass").val() == "") {
      alert("Vous devez remplir le champ confirmer votre nouveau mot de passe");
      return false;
    }

    if ($("#cpass").val() != pass) {
      alert(
        "Vous devez inscrire le même  mot de passe que le champ nouveau mot de passe"
      );
      return false;
    }

    $.ajax({
      type: "post",
      url: "php/mdp.php",
      data: { apass: apass, pass: pass },
      success: function(data) {
        alert(data);
        if (data == "Votre mot de passe a été changé avec succès") {
          $("#apass").val("");
          $("#pass").val("");
          $("#cpass").val("");
        }
      }
    });
  });

  $("#profilForm").submit(function(e) {
    e.preventDefault();

    var numcivic = $("#numCivic").val();
    var rue = $("#rue").val();
    var ville = $("#ville").val();
    var pays = $("#pays").val();
    var codepostal = $("#codePostal").val();
    var tel = $("#tel").val();

    if (numcivic == "") {
      alert("Vous devez inscrire votre numéro civic");
      return false;
    }

    if (rue == "") {
      alert("Vous devez inscrire votre rue");
      return false;
    }

    if (ville == "") {
      alert("Vous devez inscrire votre ville");
      return false;
    }

    if (pays == "") {
      alert("Vous devez inscrire votre pays");
      return false;
    }

    if (codepostal == "") {
      alert("Vous devez inscrire votre code postal");
      return false;
    }

    if (tel == "") {
      alert("Vous devez inscrire votre numéro de téléphone");
      return false;
    }
    var isnum = /^\d+$/.test(numcivic);
    if (!isnum) {
      alert("Entrer un numéro civic valide");
      return false;
    }
    var iscodepostal = /[A-Za-z][0-9][A-Za-z]\s?[0-9][A-Za-z][0-9]/.test(
      codepostal
    );
    if (!iscodepostal) {
      alert("Entrer un code postal valide");
      return false;
    }
    var istel = /\([2-9][0-8][0-9]\)\s[2-9][0-9][0-9]\W[0-9]{4}/.test(tel);
    if (!istel) {
      alert("Entrer un numéro de téléphone valide");
      return false;
    }
    codepostal = codepostal.toUpperCase().replace(" ", "");

    $.ajax({
      type: "post",
      url: "php/profil.php",
      data: {
        numcivic: numcivic,
        rue: rue,
        ville: ville,
        pays: pays,
        codepostal: codepostal,
        tel: tel
      },
      success: function(data) {
        alert(data);
        location.reload();
      }
    });
  });

  $(document).on("click", "#gestionProduit", function() {
    window.location.href = "index.php?page=gestionProduit";
  });

  $(document).on("click", "#listeClients", function() {
    window.location.href = "index.php?page=listeClients";
  });

  $(document).on("click", "#changementMotPass", function() {
    window.location.href = "index.php?page=changementMotPass";
  });

  $(document).on("click", "#profil", function() {
    window.location.href = "index.php?page=profil";
  });

  $(document).on("click", "#commande", function() {
    window.location.href = "index.php?page=commande";
  });

  $(document).on("click", "#commandes", function() {
    window.location.href = "index.php?page=commandes";
  });

  $("input[type=text]").blur(function() {
    $(this).val(
      $(this)
        .val()
        .trim()
    );
  });
  $("textarea").blur(function() {
    $(this).val(
      $(this)
        .val()
        .trim()
    );
  });
});
