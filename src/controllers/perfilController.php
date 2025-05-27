<?php
require_once __DIR__ . "/../models/estudianteModel.php";
require_once __DIR__ . "/../models/profesorModel.php";
require_once __DIR__ . "/../models/adminModel.php";
require_once __DIR__ . "/../models/grupoModel.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../includes/config.php";
require_once __DIR__ . "/../models/usuarioModel.php";

$conexion = getConnection();
$bbdd = getBBDD();

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

function showProfilePage(mysqli $conexion, string $bbdd, int $user_id)
{
   $userData = getUsuarioById($conexion, $bbdd, $user_id);
   switch ($_SESSION["rol"]) {
      case "admin":
         $rolData = getAdminByUserId($conexion, $bbdd, $user_id);
         $list = getProfesores($conexion, $bbdd);
         break;
      case "profesor":
         $rolData = getProfesorByUserId($conexion, $bbdd, $user_id);
         break;
      case "estudiante":
         $rolData = getEstudianteByUserId($conexion, $bbdd, $user_id);
         $gradesAux = getNotasEstudiante($conexion, $bbdd, $rolData["id"]);
         $grades = [];
         foreach ($gradesAux as $nota) {
            $grades[$nota["curso_id"]][] = $nota;
         }
         break;
   }
   require __DIR__ . "/../views/perfil.php";
}
