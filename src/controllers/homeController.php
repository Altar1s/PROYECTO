<?php
require_once __DIR__ . "/../models/estudianteModel.php";
require_once __DIR__ . "/../models/profesorModel.php";
require_once __DIR__ . "/../models/grupoModel.php";
require_once __DIR__ . "/../models/adminModel.php";
require_once __DIR__ . "/../models/publicacionModel.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../includes/config.php";

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

function showHomePage(mysqli $conexion, string $bbdd)
{
   if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin") {
      require __DIR__ . '/../views/partials/addPublication.php';
   }
   require __DIR__ . '/../views/partials/homeTabs.php';
   $publications_data = getPublicaciones($conexion, $bbdd);
   require __DIR__ . '/../views/home.php';
}
