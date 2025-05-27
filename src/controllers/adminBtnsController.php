<?php
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . "/../models/profesorModel.php";
require_once __DIR__ . "/../models/estudianteModel.php";
require_once __DIR__ . '/../models/grupoModel.php';
require_once __DIR__ . "/../models/adminModel.php";

if (!isset($_GET["request"])) {
   return;
}

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$dataRequested = $_GET["request"];
$conexion = getConnection();
$bbdd = getBBDD();

switch ($dataRequested) {
   case "professors":
      $list = getProfesores($conexion, $bbdd);
      $entity = "profesor";
      require __DIR__ . "/../views/partials/tableAdmin.php";
      break;
   case "students":
      $list = getEstudiantes($conexion, $bbdd);
      $entity = "estudiante";
      require __DIR__ . "/../views/partials/tableAdmin.php";
      break;
   case "groups":
      $list = getGrupos($conexion, $bbdd);
      $entity = "grupo";
      require __DIR__ . "/../views/partials/tableAdmin.php";
      break;
   case "admins":
      $list = getAdmins($conexion, $bbdd);
      $entity = "admin";
      require __DIR__ . "/../views/partials/tableAdmin.php";
      break;
}
