<?php
header('Content-Type: application/json');
try {
   require("./../includes/conexion.php");
   if (mysqli_select_db($conexion, $bbdd)) {
      $query = null;
      if ($_GET["tipo"] == "publicaciones") {
         $query = "SELECT * FROM publicaciones ORDER BY fecha_publicacion DESC";
      } else {
         session_start();
         $user_id =  $_SESSION['user_id'];
         if ($_SESSION["rol"] == "estudiante") {
            $query = "SELECT * FROM estudiantes WHERE user_id=$user_id";
            $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
            $query = "SELECT * FROM cursos_estudiantes WHERE estudiante_id = {$resultado["id"]} ORDER BY curso_id DESC";
            $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
            $query = "SELECT * FROM cursos WHERE id = {$resultado["curso_id"]}";
         } else {
            $query = "SELECT * FROM profesores WHERE user_id=$user_id";
            $resultado = mysqli_fetch_assoc(mysqli_query($conexion, $query));
            $query = "SELECT * FROM cursos WHERE profesor_id = {$resultado["id"]} ORDER BY id DESC";
         }
      }
      $resultado = mysqli_query($conexion, $query);
      $datos = [];
      while ($fila = mysqli_fetch_assoc($resultado)) {
         $datos[] = $fila;
      }
      echo json_encode($datos);
      mysqli_close($conexion);
   }
} catch (Throwable $t) {
   echo "wa";
}
