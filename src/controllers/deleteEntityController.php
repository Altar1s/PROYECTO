<?php
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../models/grupoModel.php';
require_once __DIR__ . "/../models/profesorModel.php";
require_once __DIR__ . "/../models/estudianteModel.php";
require_once __DIR__ . "/../models/adminModel.php";

if (!isset($_POST["entity"])) {
   return;
}

$conexion = getConnection();
$bbdd = getBBDD();
$entity = $_POST["entity"];
$id = $_POST["id"];

switch ($entity) {
   case "profesor":
      deleteProfessor($conexion, $bbdd, $id);
      break;

   case "estudiante":
      deleteStudent($conexion, $bbdd, $id);
      break;

   case "grupo":
      deleteGroup($conexion, $bbdd, $id);
      break;

   case "admin":
      deleteAdmin($conexion, $bbdd, $id);
      break;
}

require __DIR__ . "/../views/partials/modals/operationSuccessful.php";
