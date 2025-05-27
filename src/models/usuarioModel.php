<?php
require_once __DIR__ . '/utils.php';

// Obtener todos los usuarios
function getUsuarios(mysqli $conexion, string $bbdd)
{
   return getAllEntities($conexion, $bbdd, "users");
}

// Obtener usuario por ID
function getUsuarioById(mysqli $conexion, string $bbdd, int $id)
{
   $query = "SELECT * FROM users WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

// Obtener usuario por email
function getUsuarioByEmail(mysqli $conexion, string $bbdd, string $email)
{
   $email = mysqli_real_escape_string($conexion, $email);
   $query = "SELECT * FROM users WHERE email = '$email'";
   return fetchOne($conexion, $bbdd, $query);
}

// Crear usuario
function addUsuario(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   if (isEmailRepeted($conexion, $bbdd, $data)) {
      return false;
   }
   $email = mysqli_real_escape_string($conexion, $data["email"]);
   $password = mysqli_real_escape_string($conexion, $data["password"]);
   $rol = mysqli_real_escape_string($conexion, $data["entity"]);
   $query = "INSERT INTO users (email, password, rol) VALUES ('$email', AES_ENCRYPT('$password','claveultrasecreta'), '$rol');";
   mysqli_query($conexion, $query);
   $user_id =  mysqli_insert_id($conexion);
   return $user_id;
}

function isEmailRepeted(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $email = $data["email"];
   $query = "SELECT * FROM users WHERE email = '$email'";
   $response = mysqli_query($conexion, $query);
   if (mysqli_num_rows($response) > 0) {
      return true;
   }
   return false;
}

function isEmailTheSame(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $email = $data["email"];
   $user_id = $data["user_id"];
   $query = "SELECT *
   FROM users
   WHERE email = '$email' AND id = $user_id;";
   $response = mysqli_query($conexion, $query);
   if (mysqli_num_rows($response) > 0) {
      return true;
   }
}

// Eliminar usuario
function deleteUsuario(mysqli $conexion, string $bbdd, int $id)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $query = "DELETE FROM users WHERE id = $id";
   return fetchOne($conexion, $bbdd, $query);
}

function editUsuario(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $email = mysqli_real_escape_string($conexion, $data["email"]);
   $user_id = $data["user_id"];

   if (isEmailTheSame($conexion, $bbdd, $data)) {
      return $user_id;
   }
   if (isEmailRepeted($conexion, $bbdd, $data)) {
      return false;
   }
   $query = "UPDATE users SET email = '$email' WHERE id = $user_id";
   mysqli_query($conexion, $bbdd);
   return $user_id;
}
