<?php
require_once __DIR__ . "/../models/perfilModel.php";
require_once __DIR__ . "/../includes/conexion.php";
require_once __DIR__ . "/../includes/config.php";

$conexion = getConnection();
$bbdd = getBBDD();

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

if (isset($_GET["type"])) {
   switch ($_GET["type"]) {
      case "professors":
         getProfessors($conexion, $bbdd);
         break;
      case "students":
         getStudents($conexion, $bbdd);
         break;
      case "groups":
         getGroups($conexion, $bbdd);
         break;
      case "eliminar":
         selectDelete($conexion, $bbdd, $_GET["entity"], $_GET["id"]);
         break;
   }
}

function selectDelete(mysqli $conexion, string $bbdd, string $entity, int $id)
{

   switch ($entity) {
      case "students":
         $query = "DELETE FROM users WHERE id = (SELECT user_id FROM estudiantes WHERE id = $id)";
         break;
      case "professors":
         $query = "DELETE FROM users WHERE id = (SELECT user_id FROM profesores WHERE id = $id)";
         break;
      case "groups":
         $query = "DELETE FROM cursos WHERE id = $id";
         break;
   }

   deleteEntity($conexion, $bbdd, $query);

   require __DIR__ . "/../views/partials/entityDeleted.php";
}

function getProfessors(mysqli $conexion, string $bbdd)
{
   $list = getProfessorsNames($conexion, $bbdd);
   require __DIR__ . "/../views/partials/tableAdmin.php";
}

function getStudents(mysqli $conexion, string $bbdd)
{
   $list = getStudentsNames($conexion, $bbdd);
   require __DIR__ . "/../views/partials/tableAdmin.php";
}

function getGroups(mysqli $conexion, string $bbdd)
{
   $list = getGroupsNames($conexion, $bbdd);
   require __DIR__ . "/../views/partials/tableAdmin.php";
}


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
