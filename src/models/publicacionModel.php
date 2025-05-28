<?php
require_once __DIR__ . '/utils.php';

function getPublicaciones(mysqli $conexion, string $bbdd)
{
   return array_reverse(getAllEntities($conexion, $bbdd, "publicaciones"));
}

function addPublicacion(mysqli $conexion, string $bbdd, array $data)
{
   if (!mysqli_select_db($conexion, $bbdd)) {
      return false;
   }
   $titulo = mysqli_real_escape_string($conexion, $data["titulo"]);
   $contenido = mysqli_real_escape_string($conexion, $data["contenido"]);
   $user_id = $_SESSION["user_id"];
   $imagenes = "";

   if (isset($data["imagenes"]) && isset($data["imagenes"]["name"])) {
      $files = $data["imagenes"];
      $path = __DIR__ . "/../../media/img/";

      foreach ($files["tmp_name"] as $key => $tmp_name) {
         if ($files["error"][$key] == 4 || empty($files["name"][$key])) {
            continue;
         }
         $originalName = basename($files["name"][$key]);
         $extension = pathinfo($originalName, PATHINFO_EXTENSION);
         $uniqueName = uniqid() . "_" . md5(time() . rand()) . "." . $extension;
         move_uploaded_file($tmp_name, $path . $uniqueName);
         $imagenes .= $uniqueName . ",";
      }
   }

   $imagenes_sql = $imagenes ? "'" . mysqli_real_escape_string($conexion, $imagenes) . "'" : 'NULL';
   $query = "INSERT INTO publicaciones (admin_id, contenido, titulo, img)
            VALUES ((SELECT id FROM admins WHERE user_id = $user_id), '$contenido', '$titulo', $imagenes_sql);";
   mysqli_query($conexion, $query);
}

function deletePublicacion(mysqli $conexion, string $bbdd, int $id)
{
   if (!mysqli_select_db($conexion, $bbdd)) {
      return false;
   }

   //eliminar imagenes
   $query = "SELECT img FROM publicaciones WHERE id = $id";
   $result = mysqli_query($conexion, $query);
   $row = mysqli_fetch_assoc($result);
   $imagenesPublicacion = $row['img'];

   if ($imagenesPublicacion) {
      $imagenes = explode(",", rtrim($imagenesPublicacion, ","));
      $path = __DIR__ . "/../../media/img/";

      foreach ($imagenes as $imagen) {
         $filePath = $path . $imagen;
         if (file_exists($filePath)) {
            unlink($filePath);
         }
      }
   }

   //eliminar publicacion
   $query = "DELETE FROM publicaciones WHERE id = $id";
   mysqli_query($conexion, $query);
}

function updatePublicacion(mysqli $conexion, string $bbdd, int $id, array $data)
{
   if (!mysqli_select_db($conexion, $bbdd)) {
      return false;
   }
   $titulo = mysqli_real_escape_string($conexion, $data["titulo"]);
   $contenido = mysqli_real_escape_string($conexion, $data["contenido"]);
   $query = "UPDATE publicaciones SET titulo = '$titulo', contenido = '$contenido' WHERE id = $id";
   mysqli_query($conexion, $query);
}
