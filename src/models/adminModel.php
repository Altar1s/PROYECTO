<?php
require_once __DIR__ . '/utils.php';

function getAdmins(mysqli $conexion, string $bbdd)
{
   return getAllEntities($conexion, $bbdd, "admins");
}

function getAdminById(mysqli $conexion, string $bbdd, int $id)
{
   $query = "SELECT * FROM admins WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

function getAdminByUserId(mysqli $conexion, string $bbdd, int $user_id)
{
   $query = "SELECT * FROM admins WHERE user_id = $user_id";
   return fetchOne($conexion, $bbdd, $query);
}

function addAdmin(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "INSERT INTO admins (nombre, apellidos, user_id) VALUES ('$nombre', '$apellidos', $user_id);";
   mysqli_query($conexion, $query);
}

function deleteAdmin(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT foto FROM users WHERE id = (SELECT user_id FROM estudiantes WHERE id = $id)";
   $result = mysqli_query($conexion, $query);
   $row = mysqli_fetch_assoc($result);
   $foto = $row['foto'] ?? null;

   if ($foto) {
      $filePath = __DIR__ . "/../../media/img/" . $foto;
      if (file_exists($filePath)) {
         unlink($filePath);
      }
   }
   $query = "DELETE FROM users WHERE id = (SELECT user_id FROM admins WHERE id = $id)";
   mysqli_query($conexion, $query);
}

function getAllInfoAdmin(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT admins.*, users.*
   FROM admins
   JOIN users ON admins.user_id = users.id
   WHERE admins.id = $id;";
   return fetchOne($conexion, $bbdd, $query);
}

function editAdmin(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "UPDATE admins SET nombre = '$nombre', apellidos = '$apellidos' WHERE id = (SELECT id FROM admins where user_id = $user_id)";
   mysqli_query($conexion, $query);
}
