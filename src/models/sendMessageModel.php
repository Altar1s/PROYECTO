<?php
header('Content-Type: application/json');
try {
   require("./../includes/conexion.php");
   if (mysqli_select_db($conexion, $bbdd)) {
      extract($_POST);
      $mensaje = mysqli_real_escape_string($conexion, $msg);
      $query = "INSERT INTO mensajes (curso_id,contenido) VALUES($chat_id,'$msg')";
      mysqli_query($conexion, $query);
      echo json_encode("Se enviaron los mensajes");
      mysqli_close($conexion);
   }
} catch (Throwable $t) {
   echo "wa";
}
