<?php
require_once __DIR__ . "/../models/perfilModel.php";
function showPage(mysqli $conexion, string $bbdd, int $user_id)
{
   $userData = getUserData($conexion, $bbdd, $user_id);
   $rolData = null;
   switch ($_SESSION["rol"]) {
      case "admin":
         $rolData = getAdminData($conexion, $bbdd, $user_id);
         break;
      case "profesor":
         $rolData = getProfessorData($conexion, $bbdd, $user_id);
         break;
      case "estudiante":
         $rolData = getStudentData($conexion, $bbdd, $user_id);
         break;
   }
   require __DIR__ . "/../views/perfil.php";
}
