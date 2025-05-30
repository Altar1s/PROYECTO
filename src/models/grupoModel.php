<?php
require_once __DIR__ . '/utils.php';

function getGrupos(mysqli $conexion, string $bbdd)
{
   return getAllEntities($conexion, $bbdd, "cursos");
}

function getGrupoById(mysqli $conexion, string $bbdd, int $id)
{
   $query = "SELECT * FROM cursos WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

function getEstudiantesDeGrupo(mysqli $conexion, string $bbdd, int $curso_id)
{
   $query = "SELECT estudiantes.*, users.foto 
FROM estudiantes
JOIN cursos_estudiantes ON estudiantes.id = cursos_estudiantes.estudiante_id
JOIN users ON estudiantes.user_id = users.id
WHERE cursos_estudiantes.curso_id = $curso_id;";
   if (!selectDB($conexion, $bbdd)) return [];
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function getProfesorDeGrupo(mysqli $conexion, string $bbdd, int $curso_id)
{
   $query = "SELECT profesores.* FROM profesores
      INNER JOIN cursos ON profesores.id = cursos.profesor_id
      WHERE cursos.id = $curso_id";
   return fetchOne($conexion, $bbdd, $query);
}

function addStudentToChat(mysqli $conexion, string $bbdd, int $curso_id, int $estudiante_id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "INSERT INTO cursos_estudiantes (curso_id, estudiante_id) VALUES ($curso_id, $estudiante_id)";
   mysqli_query($conexion, $query);
}

function getStudentsNotInChat(mysqli $conexion, string $bbdd, int $chatId)
{
   $query = "SELECT estudiantes.*, users.foto 
      FROM estudiantes
      JOIN users ON estudiantes.user_id = users.id
      WHERE estudiantes.id NOT IN (
         SELECT estudiante_id FROM cursos_estudiantes WHERE curso_id = $chatId
      )";
   if (!selectDB($conexion, $bbdd)) return [];
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function addGroup(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $profesor_id = $data["profesor"];
   $query = "INSERT INTO cursos (nombre, profesor_id) VALUES ('$nombre',$profesor_id);";
   mysqli_query($conexion, $query);
}

function deleteGroup(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "DELETE FROM cursos WHERE id = $id";
   mysqli_query($conexion, $query);
}

function editGroup(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $nombre = mysqli_real_escape_string($conexion, $data['nombre']);
   $profesor_id = $data["profesor"];
   $id = $data["id"];
   $query = "UPDATE cursos SET nombre = '$nombre', profesor_id = $profesor_id WHERE id = $id";
   mysqli_query($conexion, $query);
}

function removeStudentFromChat(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $chatId = $data["chatId"];
   $studentId = $data["studentId"];
   $query = "DELETE FROM cursos_estudiantes WHERE curso_id = $chatId AND estudiante_id = $studentId";
   mysqli_query($conexion, $query);
   return true;
}
