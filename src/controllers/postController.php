<?php
require_once __DIR__ . '/../includes/conexion.php';
require_once __DIR__ . '/../includes/config.php';
require_once __DIR__ . '/../models/publicacionModel.php';

if (!isset($_POST["type"])) {

   return;
}

if (session_status() == PHP_SESSION_NONE) {
   session_start();
}

$conexion = getConnection();
$bbdd = getBBDD();
$actionType = $_POST["type"];

switch ($actionType) {
   case "delete":
      $postId = $_POST["id"];
      deletePublicacion($conexion, $bbdd, $postId);
      $publications_data = getPublicaciones($conexion, $bbdd);
      require_once __DIR__ . '/../views/partials/publications.php';
      break;
   case "edit":
      $title = $_POST["postTitle"];
      $content = $_POST["postContent"];
      $postId = $_POST["id"];
      require_once __DIR__ . '/../views/partials/editPublication.php';
}
