<?php
require_once __DIR__ . "/../models/homeModel.php";
require_once __DIR__ . "/../includes/conexion.php";
if (session_status() == PHP_SESSION_NONE) {
   session_start();
}
$conexion = getConnection();
if (isset($_GET["tipo"])) {
   switch ($_GET["tipo"]) {
      case "Publicaciones":
         returnPublications($conexion);
         break;
      case "Chats":
         returnChats($conexion);
         break;
      case "chat":
         returnChat($conexion, $_GET["chat_id"]);
         break;
   }
}

function returnPublications(mysqli $conexion)
{
   $publications_data = getPublications($conexion);
   require __DIR__ . "/../views/partials/publications.php";
}

function returnChats(mysqli $conexion)
{
   if ($_SESSION["rol"] == "estudiante") {
      $chats_data = getChatsStudent($conexion, $_SESSION["user_id"]);
   } else {
      $chats_data = getChatsProfessor($conexion, $_SESSION["user_id"]);
   }
   require __DIR__ . "/../views/partials/chats.php";
}

function returnChat(mysqli $conexion, int $chat_id)
{
   $mensajes = getMessagesFromChat($conexion, $chat_id);
   $chat = getChatData($conexion, $chat_id);
   require __DIR__ . "/../views/partials/chat.php";
}

/**
 * Carga las vistas correspondientes según el rol del usuario.
 *
 * - Admin: muestra la opción para agregar publicaciones.
 * - Estudiante o profesor: muestra las pestañas de contenido general y chats.
 *
 * @return void
 */
function showHomePage()
{
   if (isset($_SESSION["logged"])) {
      switch ($_SESSION["rol"]) {
         case "admin":
            include __DIR__ . "/../views/partials/addPublication.php";
            break;
         case "profesor":
            include __DIR__ . "/../views/partials/homeTabs.php";
            break;
         case "alumno":
            include __DIR__ . "/../views/partials/homeTabs.php";
            break;
      }
   }
   require __DIR__ . "/../views/home.php";
}
