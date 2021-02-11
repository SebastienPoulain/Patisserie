<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>

  <title>Délices et Merveilles</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ion-rangeslider/2.3.0/css/ion.rangeSlider.min.css"/>
  <link rel="stylesheet" href="css/master.css">
  <link rel="stylesheet" href="css/panel.css">
  <link rel="stylesheet" href="css/slider.css">
  <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>

  <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-148109975-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-148109975-2');
</script>

</head>


<body>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script src="js/panel.js" charset="utf-8"></script>
<script src="js/script.js" charset="utf-8"></script>
<script src="https://www.paypal.com/sdk/js?client-id=AZDyA0R7qjmrxpq58d1_Dfkw4boUhbs3HGRGRh3Fh1cnbOkLT6wmQFHnkdu86SwhxiIPloNUFhfZpU7z&currency=CAD&disable-card=visa,mastercard,amex,discover,jcb,elo,hiper" charset="utf-8"></script>

<main class="cd-main-content">

    <!-- Navbar -->
    <div id="menu" class="w3-top">
        <div class="w3-bar w3-brown w3-card w3-left-align w3-large">
            <a class="w3-bar-item w3-button w3-hide-large w3-left w3-padding-large w3-hover-white w3-large w3-brown"
               href="javascript:void(0);" onclick="afficherMenuP()" title="Afficher le menu de navigation"><i
                        class="fa fa-bars"></i></a>
            <a id="accueil" href="?page=accueil" rel="external"
               class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white">Accueil</a>
            <a id="propos2" onclick="$(this).addClass('w3-white');$('#accueil').removeClass('w3-white');"
   href="?page=accueil#propos" rel="external"
            class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white">À propros</a>
            <a href="?page=recherche"
               class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white">Rechercher une
                pâtisserie</a>
            <a href="?page=contact"
               class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-padding-large w3-hover-white">Contact</a>

            <a id="BTlogin" href="#0" style="float:right;"
               class="w3-bar-item w3-button w3-padding-large w3-hover-white w3-border-left js-cd-panel-trigger"
               data-panel="main"><i class="fas fa-sign-in-alt" aria-hidden="true"></i> <span
                        class="w3-hide-small">Compte</span></a>
            <a href="?page=panier" style="float:right; max-height: 51px;" class="w3-bar-item w3-button w3-padding-large w3-hover-white"><i
                        style="font-size: 27px;" class="fa fa-shopping-cart fa-fw "></i><span id="cartCountContainer"><span id="cartCount" class="w3-badge w3-black" style="font-weight: bold;"><?php if (isset($_SESSION['articlectr'])) {
    echo $_SESSION['articlectr'];
} else {
    echo "0";
}
?></span></span></a>
        </div>

        <!-- Navbar petits écrans -->
        <div id="menuP" class="w3-bar-block w3-white w3-hide w3-hide-large w3-large">
            <a id="accueilP" href="?page=accueil" rel="external"
               class="w3-bar-item w3-button w3-padding-large">Accueil</a>
            <a id="proposP" href="?page=accueil#propos" rel="external" class="w3-bar-item w3-button w3-padding-large">À
                propros</a>
            <a href="?page=recherche" class="w3-bar-item w3-button w3-padding-large">Rechercher une pâtisserie</a>
            <a href="?page=contact" class="w3-bar-item w3-button w3-padding-large">Contact</a>
        </div>
    </div><?php
if (isset($_GET['page'])) {
    switch ($_GET['page']) {
        case 'recherche':
            include 'recherche_pat.php';
            break;

        case 'contact':
            include 'contact.php';
            break;

        case 'panier':
            include 'panier.php';
            break;

        case 'patisserie':
            include 'infoPatisserie.php';
            break;

        case 'gestionProduit':
            include 'gestionProduit.php';
            break;

        case 'listeClients':
            include 'listeClients.php';
            break;

        case 'changementMotPass':
            include 'changePass.php';
            break;

        case 'profil':
            include 'profil.php';
            break;

        case 'commande_details':
            include 'commande_details.php';
            break;

        case 'commande':
            include 'commande.php';
            break;

        case 'commandes':
            include 'commandes.php';
            break;

        case 'checkout':
            include 'checkout.php';
            break;

        default:
            include 'main.php';
            break;
    }
} else {
    include 'main.php';
}

?>

      <!-- Footer -->
      <footer class="w3-container w3-center w3-opacity">
        <div class="w3-xlarge w3-padding-32">
          <i class="fab fa-facebook w3-hover-opacity"></i>
          <i class="fab fa-instagram w3-hover-opacity"></i>
          <i class="fab fa-snapchat w3-hover-opacity"></i>
          <i class="fab fa-pinterest-p w3-hover-opacity"></i>
          <i class="fab fa-twitter w3-hover-opacity"></i>
          <i class="fab fa-linkedin w3-hover-opacity"></i>
        </div>

        <p><i class="fas fa-copyright" aria-hidden="true"></i> Copyright Sébastien Poulain & Frédéric Annequin</p>
      </footer>

</main>


<div class="cd-panel cd-panel--from-right js-cd-panel-main w3-top">
    <header class="cd-panel__header w3-brown">
        <h1 id="panelTitre" class="w3-text-white">Connexion</h1>
        <a href="#0" class="cd-panel__close js-cd-close">Close</a>
    </header>

    <div class="cd-panel__container">
        <div class="cd-panel__content w3-sand"><?php if (empty($_SESSION['email'])) {?>

                <div id="login_error" class="w3-red" style="visibility: hidden">
                    <p class="w3-large w3-text-white w3-center">Erreur de connexion</p>
                </div>

                <form id="form_login" class="w3-container" method="POST">
                    <label class="w3-text-brown"><b>Email</b></label>
                    <input id="email" required class="w3-input w3-border w3-light-grey w3-round w3-margin-bottom" type="email">


                    <label class="w3-text-brown"><b>Password</b></label>
                    <input id="password" required class="w3-input w3-border w3-light-grey w3-round" type="password">

                    <input type="submit" class="w3-btn w3-brown w3-margin-top w3-block" value="Connexion">

                    <span class="w3-right w3-padding w3-hide-small"><a  style="cursor:pointer" id="forgot_link">Mot de passe oublié ?</a></span>
                </form>

                <div id="register">
                    <p>Pour acheter nos pâtisseries en ligne et profiter de la livraison à domicile, vous pouvez créer
                        un compte en cliquant sur le bouton ci-dessous</p>
                    <input type="button" value="Créer un compte" class="w3-btn w3-brown w3-block w3-padding-16"
                           onclick="document.getElementById('register-container').style.display='block'">
                </div><?php } else {?>

                  <div id="logged">
                    <p>Bienvenue <?=$_SESSION['prenom'] . " " . $_SESSION['nom']?> !</p>
                    <br>
                    <input  class="w3-input w3-border   w3-button  w3-margin-bottom w3-brown w3-round" id="changementMotPass" type="button" value="Changement de mot de passe"><?php if ($_SESSION["type"] == "U") {echo '  <input  class="w3-input w3-border   w3-button  w3-margin-bottom w3-brown w3-round" id="commande" type="button" value="Mes commandes">
                        <input  class="w3-input w3-border   w3-button  w3-margin-bottom w3-brown w3-round" id="profil" type="button" value="Profil">';}?><?php if ($_SESSION["type"] == "A") {echo ' <input type="button" value="Créer un compte admin" class="w3-input w3-border w3-button  w3-margin-bottom w3-brown w3-round" onclick="document.getElementById(\'registerAdmin-container\').style.display=\'block\'">
                     <input  class="w3-input w3-border   w3-button  w3-margin-bottom w3-brown w3-round" id="commandes" type="button" value="Liste des commandes">
                    <input id="gestionProduit" class="w3-input w3-border   w3-button  w3-margin-bottom w3-brown w3-round" type="button" value="Gestion de produits">
                    <input id="listeClients" class="w3-input w3-border  w3-button  w3-margin-bottom w3-brown w3-round" type="button" value="Liste des clients"> ';}?>
                    <input id="logout" class="w3-input w3-border w3-button w3-brown w3-round" type="button" value="Déconnexion"
                    onclick="document.getElementById('logout-container').style.display='block'">
                  </div><?php }?>
        </div>
    </div>
</div>

<div id="register-container" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-center">
            <h1 class="w3-brown">Inscription</h1>
            <span onclick="document.getElementById('register-container').style.display='none'"
                  class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-text-white" title="Close Modal">&times;</span>
        </div>

        <form id="form_register" class="w3-container" method="POST">
            <div class="w3-section">
                <label><b>Nom</b></label>
                <input id="regNom" class="w3-input w3-border w3-margin-bottom w3-round" type="text"
                       placeholder="Entrer votre nom" required>
                <label><b>Prénom</b></label>
                <input id="regPrenom" class="w3-input w3-border w3-margin-bottom w3-round" type="text"
                       placeholder="Entrer votre prénom" required>
                <label><b>Email</b></label>
                <input id="regEmail" class="w3-input w3-border w3-margin-bottom w3-round" type="email"
                       placeholder="example@example.com" required>
                <label><b>Mot de passe</b></label>
                <input id="regPass1" class="w3-input w3-border w3-margin-bottom" type="password"
                       placeholder="Entrer un mot de passe" required>
                <label><b>Confirmer le mot de passe</b></label>
                <input id="regPass2" class="w3-input w3-border" type="password"
                       placeholder="Confirmer votre mot de passe" required>
                <button class="w3-button w3-block w3-brown w3-section w3-padding" type="submit">Valider</button>
            </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('register-container').style.display='none'" type="button"
                    class="w3-button w3-red">Annuler
            </button>
        </div>

    </div>

</div>

<div id="registerAdmin-container" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-center">
            <h1 class="w3-brown">Inscription admin</h1>
            <span onclick="document.getElementById('registerAdmin-container').style.display='none'"
                  class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-text-white" title="Close Modal">&times;</span>
        </div>

        <form id="form_registerAdmin" class="w3-container" method="POST">
            <div class="w3-section">
                <label><b>Nom</b></label>
                <input id="regAdminNom" class="w3-input w3-border w3-margin-bottom w3-round" type="text"
                       placeholder="Entrer votre nom" required>
                <label><b>Prénom</b></label>
                <input id="regAdminPrenom" class="w3-input w3-border w3-margin-bottom w3-round" type="text"
                       placeholder="Entrer votre prénom" required>
                <label><b>Email</b></label>
                <input id="regAdminEmail" class="w3-input w3-border w3-margin-bottom w3-round" type="email"
                       placeholder="example@example.com" required>
                <label><b>Mot de passe</b></label>
                <input id="regAdminPass1" class="w3-input w3-border w3-margin-bottom" type="password"
                       placeholder="Entrer un mot de passe" required>
                <label><b>Confirmer le mot de passe</b></label>
                <input id="regAdminPass2" class="w3-input w3-border" type="password"
                       placeholder="Confirmer votre mot de passe" required>
                <button class="w3-button w3-block w3-brown w3-section w3-padding" type="submit">Valider</button>
            </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('registerAdmin-container').style.display='none'" type="button"
                    class="w3-button w3-red">Annuler
            </button>
        </div>

    </div>

</div>

<div id="forgot-container" class="w3-modal">
    <div class="w3-modal-content w3-card-4" style="max-width:600px">

        <div class="w3-center">
            <h1 class="w3-brown">Mot de passe oublié</h1>
            <span onclick="document.getElementById('forgot-container').style.display='none'"
                  class="w3-button w3-xlarge w3-hover-red w3-display-topright w3-text-white" title="Close Modal">&times;</span>
        </div>

        <form id="form_forgot" class="w3-container" method="POST">
            <div class="w3-section">
                <label><b>Adresse courriel</b></label>
                <input id="forgotEmail" class="w3-input w3-border w3-margin-bottom w3-round" type="email"
                       placeholder="Entrer votre adresse courriel">
                <button class="w3-button w3-block w3-brown w3-section w3-padding" type="submit">Envoyer</button>
            </div>
        </form>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button onclick="document.getElementById('forgot-container').style.display='none'" type="button"
                    class="w3-button w3-red">Annuler
            </button>
        </div>

    </div>

</div>



<div id="logout-container" class="w3-modal">
    <div class="w3-modal-content w3-card-4 w3-animate-zoom" style="max-width:600px">

        <div class="w3-center">
            <h1 id="confirmTitle" class="w3-brown"></h1>
        </div>

        <div id="form_register" class="w3-container" method="POST">
            <div class="w3-section">
              <p id="confirmText" class="w3-center"></p>
            </div>
        </div>

        <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
            <button id="logoutConfirm" onclick="document.getElementById('logout-container').style.display='none'" type="button"
                    class="w3-button w3-brown w3-right">Ok
            </button>
        </div>

    </div>

</div>



</div>

</body>

</html>
