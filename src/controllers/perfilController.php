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
         $tab = "Profesores";
         break;
      case "profesor":
         $rolData = getProfessorData($conexion, $bbdd, $user_id);
         $tab = "Alumnos";
         break;
      case "estudiante":
         $rolData = getStudentData($conexion, $bbdd, $user_id);
         $tab = "Notas";
         break;
   }
   require __DIR__ . "/../views/perfil.php";
}
