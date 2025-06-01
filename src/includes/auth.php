<?php

//Verifica si el usuario ha iniciado sesión. Si no, redirige a la página de login.
function authLogged()
{
   if (session_status() == PHP_SESSION_NONE) {
      session_start();
   }
   if (!isset($_SESSION["logged"])) {
      session_destroy();
      header("Location: index.php?status=nologged");
      exit;
   }
}
