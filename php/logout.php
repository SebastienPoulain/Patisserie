<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
setcookie(session_name(), "", time() - 3600);
session_destroy();
session_write_close();
