<?php
require_once __DIR__ . '/../models/mensajeModel.php';
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../models/notaModel.php';
require_once __DIR__ . '/../models/grupoModel.php';
require_once __DIR__ . '/../models/publicacionModel.php';
require_once __DIR__ . "/../models/profesorModel.php";
require_once __DIR__ . "/../models/estudianteModel.php";
require_once __DIR__ . "/../models/usuarioModel.php";
require_once __DIR__ . "/../models/adminModel.php";

if (!isset($_POST["type"])) {
   return;
}

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$conexion = getConnection();
$bbdd = getBBDD();
$formType = $_POST["type"];

switch ($formType) {
   case "addPublication":
      $data = $_POST;
      if (isset($_FILES["imagenes"])) {
         $data["imagenes"] = $_FILES["imagenes"];
      }
      addPublicacion($conexion, $bbdd, $data);
      $publications_data = getPublicaciones($conexion, $bbdd);
      require __DIR__ . "/../views/partials/publications.php";
      break;

   case "sendMessage":
      $chatId = $_POST["chatId"];
      enviarMensajeAGrupo($conexion, $bbdd, $_POST);
      $mensajes = getMensajesDeGrupo($conexion, $bbdd, $chatId);
      require __DIR__ . "/../views/partials/mensajes.php";
      break;

   case "editGrades":
      $studentId = $_POST["student-id"];
      $chatId = $_POST["chat-id"];
      $notas = [$_POST["nota1"], $_POST["nota2"], $_POST["nota3"]];
      setNotasEstudiante($conexion, $bbdd, $studentId, $chatId, $notas);
      $grades = getNotasDeEstudianteEnCurso($conexion, $bbdd, $studentId, $chatId);
      require __DIR__ . "/../views/partials/editGrade.php";
      require __DIR__ . "/../views/partials/gradesUpdated.php";
      break;

   case "addStudentToChat":
      $chatId = $_POST["chatId"];

      if (!isset($_POST["studentId"])) {
         require __DIR__ . "/../views/partials/errorAddingMember.php";
      } else {
         require __DIR__ . "/../views/partials/memberAdded.php";
         $studentId = $_POST["studentId"];
         addStudentToChat($conexion, $bbdd, $chatId, $studentId);
      }

      $members = getEstudiantesDeGrupo($conexion, $bbdd, $chatId);
      require __DIR__ . "/../views/partials/chatMembers.php";
      break;

   case "editPost":
      $postID = $_POST["id"];
      updatePublicacion($conexion, $bbdd, $postID, $_POST);
      $publications_data = getPublicaciones($conexion, $bbdd);
      require __DIR__ . "/../views/partials/publications.php";
      break;

   case "addEntity":
      $entity = $_POST["entity"];

      if ($entity == "grupo") {
         addGroup($conexion, $bbdd, $_POST);
         require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
         return;
      }

      $response = addUsuario($conexion, $bbdd, $_POST);

      if (!$response) {
         require __DIR__ . "/../views/partials/modals/emailError.php";
         return;
      }

      if ($entity == "profesor") {
         addProfessor($conexion, $bbdd, $_POST, $response);
      }
      if ($entity == "estudiante") {
         addStudent($conexion, $bbdd, $_POST, $response);
      }
      if ($entity == "admin") {
         addAdmin($conexion, $bbdd, $_POST, $response);
      }
      require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
      break;

   case "editEntity":
      $entity = $_POST["entity"];

      if ($entity == "grupo") {
         editGroup($conexion, $bbdd, $_POST);
         require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
         return;
      }

      $response = editUsuario($conexion, $bbdd, $_POST);

      if (!$response) {
         require __DIR__ . "/../views/partials/modals/emailError.php";
         return;
      }

      if ($entity == "profesor") {
         editProfessor($conexion, $bbdd, $_POST, $response);
      }
      if ($entity == "estudiante") {
         editStudent($conexion, $bbdd, $_POST, $response);
      }
      if ($entity == "admin") {
         editAdmin($conexion, $bbdd, $_POST, $response);
      }
      require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
      break;

   case "change-password":
      $user_id = $_SESSION["user_id"];
      $response = updateUserPassword($conexion, $bbdd, $_POST, $user_id);
      if (!$response) {
         require __DIR__ . "/../views/partials/modals/passwordError.php";
         return;
      }
      require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
      break;
}
