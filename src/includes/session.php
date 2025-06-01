<?php
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if (isset($_SESSION["logged"]) && !isset($_GET["page"])) {
   header("Location: ./index.php?page=home");
   exit;
}

if (!isset($_SESSION["logged"]) && isset($_GET["page"])) {
   header("Location: ./index.php?status=nologged");
   exit;
}

if (isset($_SESSION["hora"]) && $_SESSION["hora"] + 3600 < time()) {
   $_SESSION = [];
   session_destroy();
   header("Location: ./index.php?status=caducado");
   exit;
}

if (isset($_SESSION["timeout"])) {
   $vida_sesion = time() - $_SESSION["timeout"];
   if ($vida_sesion > 900) {
      $_SESSION = [];
      session_destroy();
      header("Location: ./index.php?status=inactividad");
      exit;
   }
}
$_SESSION["timeout"] = time();
