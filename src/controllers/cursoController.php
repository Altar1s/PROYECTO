<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/../models/grupoModel.php';
require_once __DIR__ . '/../models/mensajeModel.php';
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../models/notaModel.php';
require_once __DIR__ . '/../models/estudianteModel.php';
require_once __DIR__ . '/../models/profesorModel.php';

if (!isset($_GET["type"])) {
   return;
}

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$conexion = getConnection();
$bbdd = getBBDD();
$type = $_GET["type"];

switch ($type) {
   case "messages":
      $chatId = $_GET["id"];
      $chatName = $_GET["nombre"];
      $mensajes = getMensajesDeGrupo($conexion, $bbdd, $chatId);

      require __DIR__ . "/../views/partials/chat.php";
      break;
   case "members":
      $chatId = $_GET["id"];
      $members = getEstudiantesDeGrupo($conexion, $bbdd, $chatId);
      require __DIR__ . "/../views/partials/chatMembers.php";
      break;
   case "show-grades":
      $chatId = $_GET["chatId"];
      $studentId = $_GET["studentId"];
      $grades = getNotasDeEstudianteEnCurso($conexion, $bbdd, $studentId, $chatId);
      require __DIR__ . "/../views/partials/editGrade.php";
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

   case "remove-member":
      if (removeStudentFromChat($conexion, $bbdd, $_GET)) {
         $chatId = $_GET["chatId"];
         $members = getEstudiantesDeGrupo($conexion, $bbdd, $chatId);
         require __DIR__ . "/../views/partials/chatMembers.php";
      }
      break;
}
