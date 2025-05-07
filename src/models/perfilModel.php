<?php

function getUserData(mysqli $conexion, string $bbdd, int $user_id)
{
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = "SELECT * FROM users WHERE id = $user_id";
      $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
      return $resultado;
   }
}

function getStudentData(mysqli $conexion, string $bbdd, int $user_id)
{
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = "SELECT * FROM estudiantes WHERE user_id = $user_id";
      $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
      return $resultado;
   }
}
function getAdminData(mysqli $conexion, string $bbdd, int $user_id)
{
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = "SELECT * FROM admins WHERE user_id = $user_id";
      $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
      return $resultado;
   }
}
function getProfessorData(mysqli $conexion, string $bbdd, int $user_id)
{
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = "SELECT * FROM profesores WHERE user_id = $user_id";
      $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
      return $resultado;
   }
}

function getStudentGrades(mysqli $conexion, string $bbdd, int $user_id)
{
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = "SELECT notas.*, cursos.nombre AS nombre_curso FROM notas JOIN cursos ON notas.curso_id = cursos.id WHERE notas.estudiante_id = $user_id ORDER BY notas.curso_id";
      $resultado = mysqli_query($conexion, $query);
      $notas = [];
      while ($fila = mysqli_fetch_assoc($resultado)) {
         $curso_id = $fila["curso_id"];
         $notas[$curso_id][] = $fila;
      }
      return $notas;
   }
}
