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
            $query = " SELECT cursos.* FROM cursos INNER JOIN cursos_estudiantes ON cursos.id = cursos_estudiantes.curso_id INNER JOIN estudiantes ON cursos_estudiantes.estudiante_id = estudiantes.id WHERE estudiantes.user_id = $user_id ORDER BY cursos.id DESC";
         } else {
            $query = "SELECT cursos.* FROM cursos INNER JOIN profesores ON cursos.profesor_id = profesores.id WHERE profesores.user_id = $user_id ORDER BY cursos.id DESC";
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
