<?php
require_once __DIR__ . '/../models/estudianteModel.php';
require_once __DIR__ . '/../models/profesorModel.php';
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . "/../models/grupoModel.php";
require_once __DIR__ . "/../models/adminModel.php";


if (!isset($_GET["modaltype"])) {
   return;
}

$conexion = getConnection();
$bbdd = getBBDD();
$modaltype = $_GET["modaltype"];

switch ($modaltype) {
   case "add-student-to-chat":
      $chatId = $_GET["chatId"];
      $data = getStudentsNotInChat($conexion, $bbdd, $chatId);
      require __DIR__ . "/../views/partials/modalAddStudentToChat.php";
      break;
   case "delete-post":
      $postId = $_GET["id"];
      require __DIR__ . "/../views/partials/modals/deletePost.php";
      break;
   case "add-entity":
      $entity = $_GET["entity"];
      $isAddModal = true;

      if ($entity == "grupo") {
         $professors = getProfesores($conexion, $bbdd);
         require __DIR__ . "/../views/partials/modals/addGroup.php";
         return;
      }
      require __DIR__ . "/../views/partials/modals/addModal.php";
      break;

   case "load":
      require __DIR__ . "/../views/partials/modals/loadingModal.php";
      break;

   case "delete-entity":
      $id = $_GET["entityId"];
      $entity = $_GET["entity"];
      require __DIR__ . "/../views/partials/deleteModal.php";
      break;

   case "edit-entity":
      $entity = $_GET["entity"];
      $id = $_GET["entityId"];
      $isAddModal = false;

      if ($entity == "grupo") {
         $dataEntity = getGrupoById($conexion, $bbdd, $id);
         $professors = getProfesores($conexion, $bbdd);
         require __DIR__ . "/../views/partials/modals/addGroup.php";
         return;
      }
      if ($entity == "profesor") {
         $dataEntity = getAllInfoProfessor($conexion, $bbdd, $id);
      }
      if ($entity == "estudiante") {
         $dataEntity = getAllInfoStudent($conexion, $bbdd, $id);
      }
      if ($entity == "admin") {
         $dataEntity = getAllInfoAdmin($conexion, $bbdd, $id);
      }

      require __DIR__ . "/../views/partials/modals/addModal.php";
      break;

   case "error-imagen":
      require __DIR__ . "/../views/partials/modals/imageError.php";
      break;

   case "change-password":
      require __DIR__ . "/../views/partials/modals/changePassword.php";
      break;

   case "remove-member":
      $chatId = $_GET["chatId"];
      $studentId = $_GET["studentId"];
      require __DIR__ . "/../views/partials/modals/removeMember.php";
      break;

   case "operation-success":
      require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
      break;
}
