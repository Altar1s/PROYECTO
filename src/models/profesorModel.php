<?php
require_once __DIR__ . '/utils.php';

function getProfesores(mysqli $conexion, string $bbdd)
{
   return getAllEntities($conexion, $bbdd, "profesores");
}

function getProfesorById(mysqli $conexion, string $bbdd, int $id)
{
   $query = "SELECT * FROM profesores WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

function getProfesorByUserId(mysqli $conexion, string $bbdd, int $user_id)
{
   $query = "SELECT * FROM profesores WHERE user_id = $user_id";
   return fetchOne($conexion, $bbdd, $query);
}

function getCursosProfesor(mysqli $conexion, string $bbdd, int $profesor_id)
{
   $query = "SELECT * FROM cursos WHERE profesor_id = $profesor_id";
   if (!selectDB($conexion, $bbdd)) return [];
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function addProfessor(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "INSERT INTO profesores (nombre, apellidos, user_id) VALUES ('$nombre', '$apellidos', $user_id);";
   mysqli_query($conexion, $query);
}

function deleteProfessor(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT foto FROM users WHERE id = (SELECT user_id FROM profesores WHERE id = $id)";
   $result = mysqli_query($conexion, $query);
   $row = mysqli_fetch_assoc($result);
   $foto = $row['foto'] ?? null;

   if ($foto) {
      $filePath = __DIR__ . "/../../media/img/" . $foto;
      if (file_exists($filePath)) {
         unlink($filePath);
      }
   }
   $query = "DELETE FROM users WHERE id = (SELECT user_id FROM profesores WHERE id = $id)";
   mysqli_query($conexion, $query);
}

function getAllInfoProfessor(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT profesores.*, users.*
   FROM profesores
   JOIN users ON profesores.user_id = users.id
   WHERE profesores.id = $id;";
   return fetchOne($conexion, $bbdd, $query);
}

function editProfessor(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "UPDATE profesores SET nombre = '$nombre', apellidos = '$apellidos' WHERE id = (SELECT id FROM profesores where user_id = $user_id)";
   mysqli_query($conexion, $query);
}
