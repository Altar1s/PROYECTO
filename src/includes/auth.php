<?php

/**
 * Verifica si el usuario ha iniciado sesión. Si no, redirige a la página de login.
 * @return void
 */
function authLogged()
{
   if (!isset($_SESSION["logged"])) {
      header("Location: index.php?error=login");
      exit;
   }
}
