<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['id_user'])){
  echo $_SESSION['id_user'];
} else {
  echo "-1";
}
