<?php
session_start();
require_once __DIR__ . "/src/includes/config.php";
require_once __DIR__ . "/src/includes/conexion.php";
$page = $_GET["page"] ?? "home";
switch ($page) {
   case "home":
      require_once __DIR__ . "/src/controllers/homeController.php";
      showPage();
      break;
   case "perfil":
      require_once __DIR__ . "/src/controllers/perfilController.php";
      showPage($conexion, $bbdd, $_SESSION["user_id"]);
      break;
   default:
      echo "<h1>404 - Página No Encontrada</h1>";
      break;
}
