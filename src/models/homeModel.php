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
   $query = "SELECT * FROM publicaciones ORDER BY fecha_publicacion DESC";
   return returnData($conexion, $query);
}

function getChatsStudent(mysqli $conexion, int $user_id)
{
   $query = "SELECT cursos.* FROM cursos INNER JOIN cursos_estudiantes ON cursos.id = cursos_estudiantes.curso_id INNER JOIN estudiantes ON cursos_estudiantes.estudiante_id = estudiantes.id WHERE estudiantes.user_id = $user_id ORDER BY cursos.id DESC";
   return returnData($conexion, $query);
}

function getChatsProfessor(mysqli $conexion, int $user_id)
{
   $query = "SELECT cursos.* FROM cursos INNER JOIN profesores ON cursos.profesor_id = profesores.id WHERE profesores.user_id = $user_id ORDER BY cursos.id DESC";
   return returnData($conexion, $query);
}

function getMessagesFromChat(mysqli $conexion, int $chat_id)
{
   $query = "SELECT * FROM MENSAJES WHERE curso_id = $chat_id ORDER BY fecha_envio ASC;";
   return returnData($conexion, $query);
}

function getChatData(mysqli $conexion, int $chat_id)
{
   $query = "SELECT * FROM cursos WHERE id = $chat_id";
   return returnData($conexion, $query);
}


// try {
//    require("./../includes/conexion.php");
//    if (mysqli_select_db($conexion, $bbdd)) {
//       $query = null;
//       if ($_GET["tipo"] == "Publicaciones") {
//          $query = "SELECT * FROM publicaciones ORDER BY fecha_publicacion DESC";
//       } else {
//          session_start();
//          $user_id =  $_SESSION['user_id'];
//          if ($_SESSION["rol"] == "estudiante") {
//             $query = " SELECT cursos.* FROM cursos INNER JOIN cursos_estudiantes ON cursos.id = cursos_estudiantes.curso_id INNER JOIN estudiantes ON cursos_estudiantes.estudiante_id = estudiantes.id WHERE estudiantes.user_id = $user_id ORDER BY cursos.id DESC";
//          } else {
//             $query = "SELECT cursos.* FROM cursos INNER JOIN profesores ON cursos.profesor_id = profesores.id WHERE profesores.user_id = $user_id ORDER BY cursos.id DESC";
//          }
//       }
//       $resultado = mysqli_query($conexion, $query);
//       $datos = [];
//       while ($fila = mysqli_fetch_assoc($resultado)) {
//          $datos[] = $fila;
//       }
//       echo json_encode($datos);
//       mysqli_close($conexion);
//    }
// } catch (Throwable $t) {
//    echo "wa";
// }
