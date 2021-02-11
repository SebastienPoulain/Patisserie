<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_POST['prixT'])){
  $_SESSION['prixT'] = $_POST['prixT'];
  $_SESSION['articles'] = $_POST['articles'];
  $_SESSION['quantites'] = $_POST['quantites'];
}
