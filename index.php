<?php
$page = $_GET["page"] ?? "home";
switch ($page) {
   case "home":
      require_once __DIR__ . "/src/controllers/homeController.php";
      showPage();
      break;
   case "perfil":
      require_once __DIR__ . "/src/controllers/perfilController.php";
      showPage();
      break;
}
