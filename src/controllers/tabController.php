<?php
require_once __DIR__ . '/../models/publicacionModel.php';
require_once __DIR__ . '/../models/profesorModel.php';
require_once __DIR__ . '/../models/estudianteModel.php';
require_once __DIR__ . '/../models/grupoModel.php';
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';


if (!isset($_GET["tab"])) {
   return;
}

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$tab = $_GET["tab"];
$conexion = getConnection();
$bbdd = getBBDD();

switch ($_GET["tab"]) {
   case "publications":
      $publications_data = getPublicaciones($conexion, $bbdd);
      require __DIR__ . '/../views/partials/publications.php';
      break;
   case "chats":
      if ($_SESSION["rol"] == "estudiante") {
         $estudiante = getEstudianteByUserId($conexion, $bbdd, $_SESSION["user_id"]);
         $chats_data = $estudiante ? getCursosEstudiante($conexion, $bbdd, $estudiante["id"]) : [];
      } else if ($_SESSION["rol"] == "profesor") {
         $profesor = getProfesorByUserId($conexion, $bbdd, $_SESSION["user_id"]);
         $chats_data = $profesor ? getCursosProfesor($conexion, $bbdd, $profesor["id"]) : [];
      } else {
         $chats_data = [];
      }
      require __DIR__ . "/../views/partials/chats.php";
      break;
}
