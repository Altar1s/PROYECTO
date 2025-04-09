<?php
header('Content-Type: application/json');
try {
   require("./../includes/conexion.php");
   if (mysqli_select_db($conexion, $bbdd) && $_GET["id"]) {
      extract($_GET);
      $query = "SELECT * FROM MENSAJES WHERE curso_id = $id ORDER BY fecha_envio ASC;";
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
