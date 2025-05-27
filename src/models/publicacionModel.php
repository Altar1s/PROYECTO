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
   if (isset($data["imagenes"]) && isset($data["imagenes"]["name"])) {
      $imagenes = "";
      $files = $data["imagenes"];
      $path = __DIR__ . "/../../media/img/";
      foreach ($files["tmp_name"] as $key => $tmp_name) {
         if ($files["error"][$key] == 4 || empty($files["name"][$key])) {
            continue;
         }
         $name = basename($files["name"][$key]);
         $size = $files["size"][$key];
         if ($size > 10485760) continue; // omitir imágenes de más de 10MB
         if (!file_exists($path . $name)) {
            move_uploaded_file($tmp_name, $path . $name);
         }
         $imagenes .= $name . ",";
      }
   }
   $imagenes_sql = $imagenes ? "'$imagenes'" : 'NULL';
   $query = "INSERT INTO publicaciones (admin_id,contenido,titulo,img) VALUES((SELECT id FROM admins WHERE user_id = $user_id ),'$contenido','$titulo',$imagenes_sql);";
   mysqli_query($conexion, $query);
}

function deletePublicacion(mysqli $conexion, string $bbdd, int $id)
{
   if (!mysqli_select_db($conexion, $bbdd)) {
      return false;
   }
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
