<?php
function returnData($conexion, $query)
{
   $resultado = mysqli_query($conexion, $query);
   $datos = [];
   while ($fila = mysqli_fetch_assoc($resultado)) {
      $datos[] = $fila;
   }

   return $datos;
}

function getPublications(mysqli $conexion)
{
   $query = "SELECT * 
   FROM publicaciones 
   ORDER BY fecha_publicacion DESC";
   return returnData($conexion, $query);
}

function getChatsStudent(mysqli $conexion, int $user_id)
{
   $query = "SELECT cursos.* 
   FROM cursos 
   INNER JOIN cursos_estudiantes ON cursos.id = cursos_estudiantes.curso_id 
   INNER JOIN estudiantes ON cursos_estudiantes.estudiante_id = estudiantes.id 
   WHERE estudiantes.user_id = $user_id 
   ORDER BY cursos.id DESC";
   return returnData($conexion, $query);
}

function getChatsProfessor(mysqli $conexion, int $user_id)
{
   $query = "SELECT cursos.* 
   FROM cursos 
   INNER JOIN profesores ON cursos.profesor_id = profesores.id 
   WHERE profesores.user_id = $user_id 
   ORDER BY cursos.id DESC";
   return returnData($conexion, $query);
}

function getMessagesFromChat(mysqli $conexion, int $chat_id)
{
   $query = "SELECT * 
   FROM MENSAJES 
   WHERE curso_id = $chat_id 
   ORDER BY fecha_envio ASC;";
   return returnData($conexion, $query);
}

function getChatData(mysqli $conexion, int $chat_id)
{
   $query = "SELECT * FROM cursos WHERE id = $chat_id";
   return returnData($conexion, $query);
}

function getChatMembers(mysqli $conexion, int $chat_id)
{
   $query = "SELECT estudiantes.*, users.foto 
   FROM cursos_estudiantes 
   INNER JOIN estudiantes ON cursos_estudiantes.estudiante_id = estudiantes.id 
   INNER JOIN users ON estudiantes.user_id = users.id 
   WHERE cursos_estudiantes.curso_id = $chat_id
   ORDER BY estudiantes.apellidos, estudiantes.nombre;";
   return returnData($conexion, $query);
}
