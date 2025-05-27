<?php
require_once __DIR__ . '/utils.php';

// Obtener todos los mensajes de un grupo (chat)
function getMensajesDeGrupo(mysqli $conexion, string $bbdd, int $curso_id)
{
   if (!selectDB($conexion, $bbdd)) return [];
   $query = "SELECT * FROM mensajes WHERE curso_id = $curso_id ORDER BY fecha_envio ASC";
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

// Enviar un mensaje a un grupo (chat)
function enviarMensajeAGrupo(mysqli $conexion, string $bbdd, array $data)
{
   $curso_id = $data['chatId'];
   $contenido = $data['contenido'];
   if (!selectDB($conexion, $bbdd)) return false;
   $contenido = mysqli_real_escape_string($conexion, $contenido);
   $query = "INSERT INTO mensajes (curso_id, contenido) VALUES ($curso_id, '$contenido')";
   mysqli_query($conexion, $query);
}
