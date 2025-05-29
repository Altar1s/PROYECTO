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

   if (isEmailRepeated($conexion, $bbdd, $data)) {
      return false;
   }

   if (isset($_FILES["foto"])) {
      $data["foto"] = $_FILES["foto"];
   }

   $email = mysqli_real_escape_string($conexion, $data["email"]);
   $password = mysqli_real_escape_string($conexion, $data["password"]);
   $rol = mysqli_real_escape_string($conexion, $data["entity"]);

   // Gestión de la foto
   $foto = "no_photo.png";
   if (isset($data["foto"]) && isset($data["foto"]["name"])) {
      $path = __DIR__ . "/../../media/img/";
      $originalName = basename($data["foto"]["name"]);
      $extension = pathinfo($originalName, PATHINFO_EXTENSION);
      $uniqueName = uniqid() . "_" . md5(time() . rand()) . "." . $extension;
      if (move_uploaded_file($data["foto"]["tmp_name"], $path . $uniqueName)) {
         $foto = $uniqueName;
      }
   }
   $query = "INSERT INTO users (email, password, rol, foto) 
   VALUES ('$email', AES_ENCRYPT('$password', 'claveultrasecreta'), '$rol', '$foto');";
   mysqli_query($conexion, $query);
   return mysqli_insert_id($conexion);
}

function editUsuario(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;
   $email = mysqli_real_escape_string($conexion, $data["email"]);
   $user_id = intval($data["user_id"]);

   if (isEmailRepeated($conexion, $bbdd, $data)) {
      return false;
   }

   if (isset($_FILES["foto"])) {
      $data["foto"] = $_FILES["foto"];
   }

   $foto_sql = "";
   if (isset($data["foto"]) && isset($data["foto"]["name"])) {
      $query = "SELECT foto FROM users WHERE id = $user_id";
      $result = mysqli_query($conexion, $query);
      $row = mysqli_fetch_assoc($result);
      $fotoAnterior = $row['foto'] ?? null;
      mysqli_free_result($result);

      if ($fotoAnterior && $fotoAnterior != "no_photo.png") {
         $filePath = __DIR__ . "/../../media/img/" . $fotoAnterior;
         if (file_exists($filePath)) {
            unlink($filePath);
         }
      }
      $path = __DIR__ . "/../../media/img/";
      $originalName = basename($data["foto"]["name"]);
      $extension = pathinfo($originalName, PATHINFO_EXTENSION);
      $uniqueName = uniqid() . "_" . md5(time() . rand()) . "." . $extension;

      if (move_uploaded_file($data["foto"]["tmp_name"], $path . $uniqueName)) {
         $foto_sql = "$uniqueName";
      }
   }

   if (isEmailTheSame($conexion, $bbdd, $data) && $foto_sql) {
      $query = "UPDATE users SET foto = '$foto_sql' WHERE id = $user_id";
   } else  if (!isEmailTheSame($conexion, $bbdd, $data) && $foto_sql) {
      $query = "UPDATE users SET email = '$email', foto = '$foto_sql' WHERE id = $user_id";
   } else if (!isEmailTheSame($conexion, $bbdd, $data) && !$foto_sql) {
      $query = "UPDATE users SET email = '$email' WHERE id = $user_id";
   } else {
      return $user_id;
   }
   mysqli_query($conexion, $query);
   return $user_id;
}



function isEmailRepeated(mysqli $conexion, string $bbdd, array $data)
{
   if (!selectDB($conexion, $bbdd)) return false;

   $email = $data["email"];

   if (isset($data["user_id"])) {
      $user_id = $data["user_id"];
      $query = "SELECT * FROM users WHERE email = '$email' AND id != $user_id";
   } else {
      $query = "SELECT * FROM users WHERE email = '$email'";
   }
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

function updateUserPassword(mysqli $conexion, string $bbdd, array $data, int $user_id)
{
   if (!selectDB($conexion, $bbdd)) return false;

   $currentPass = mysqli_real_escape_string($conexion, $data["currentPass"]);
   $newPass = mysqli_real_escape_string($conexion, $data["newPass"]);

   $query = "SELECT id FROM users WHERE id = $user_id AND AES_DECRYPT(password, 'claveultrasecreta') = '$currentPass';";
   $result = mysqli_query($conexion, $query);

   if (mysqli_num_rows($result) == 1) {
      $query = "UPDATE users SET password = AES_ENCRYPT('$newPass', 'claveultrasecreta') WHERE id = $user_id;";
      mysqli_query($conexion, $query);
      return true;
   }
   return false;
}
