<?php
require_once __DIR__ . '/utils.php';

function getEstudiantes(mysqli $conexion, string $bbdd)
{
   return getAllEntities($conexion, $bbdd, "estudiantes");
}

function getEstudianteById(mysqli $conexion, string $bbdd, int $id)
{
   $query = "SELECT * FROM estudiantes WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

function getEstudianteByUserId(mysqli $conexion, string $bbdd, int $user_id)
{
   $query = "SELECT * FROM estudiantes WHERE user_id = $user_id";
   return fetchOne($conexion, $bbdd, $query);
}

function getCursosEstudiante(mysqli $conexion, string $bbdd, int $estudiante_id)
{
   $query = "SELECT cursos.* FROM cursos
      INNER JOIN cursos_estudiantes ON cursos.id = cursos_estudiantes.curso_id
      WHERE cursos_estudiantes.estudiante_id = $estudiante_id";
   if (!selectDB($conexion, $bbdd)) return [];
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function getNotasEstudiante(mysqli $conexion, string $bbdd, int $estudiante_id)
{
   $query = "SELECT notas.*, cursos.nombre AS nombre_curso FROM notas
      JOIN cursos ON notas.curso_id = cursos.id
      WHERE notas.estudiante_id = $estudiante_id
      ORDER BY notas.curso_id";
   if (!selectDB($conexion, $bbdd)) return [];
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function addStudent(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "INSERT INTO estudiantes (nombre, apellidos, user_id) VALUES ('$nombre', '$apellidos', $user_id);";
   mysqli_query($conexion, $query);
}

function deleteStudent(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT foto FROM users WHERE id = (SELECT user_id FROM estudiantes WHERE id = $id)";
   $result = mysqli_query($conexion, $query);
   $row = mysqli_fetch_assoc($result);
   $foto = $row['foto'] ?? null;

   if ($foto && $foto != "no_photo.png") {
      $filePath = __DIR__ . "/../../media/img/" . $foto;
      if (file_exists($filePath)) {
         unlink($filePath);
      }
   }
   $query = "DELETE FROM users WHERE id = (SELECT user_id FROM estudiantes WHERE id = $id)";
   mysqli_query($conexion, $query);
}

function getAllInfoStudent(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "SELECT estudiantes.*, users.*
   FROM estudiantes
   JOIN users ON estudiantes.user_id = users.id
   WHERE estudiantes.id = $id;";
   return fetchOne($conexion, $bbdd, $query);
}

function editStudent(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $apellidos = mysqli_real_escape_string($conexion, $data['apellidos']);
   $query = "UPDATE estudiantes SET nombre = '$nombre', apellidos = '$apellidos' WHERE id = (SELECT id FROM estudiantes where user_id = $user_id)";
   mysqli_query($conexion, $query);
}
