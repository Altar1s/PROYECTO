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
