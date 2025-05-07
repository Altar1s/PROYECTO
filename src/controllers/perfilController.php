<?php
require_once __DIR__ . "/../models/perfilModel.php";
/**
 * Carga el perfil del usuario
 *
 * @return void
 */
function showProfilePage(mysqli $conexion, string $bbdd, int $user_id)
{
   $userData = getUserData($conexion, $bbdd, $user_id);
   switch ($_SESSION["rol"]) {
      case "admin":
         $rolData = getAdminData($conexion, $bbdd, $user_id);
         break;
      case "profesor":
         $rolData = getProfessorData($conexion, $bbdd, $user_id);
         break;
      case "estudiante":
         $rolData = getStudentData($conexion, $bbdd, $user_id);
         $grades = getStudentGrades($conexion, $bbdd, $rolData["id"]);
         break;
   }
   require __DIR__ . "/../views/perfil.php";
}
