<?php
if (isset($_POST["enviar"])) {
   extract($_POST);
   try {
      require("./conexion.php");
      //EVITAR INYECCION DE CODIGO
      $correo = mysqli_real_escape_string($conexion, $correo);
      $clave = mysqli_real_escape_string($conexion, $clave);
      //QUERY
      if (mysqli_select_db($conexion, $bbdd)) {
         $query = "SELECT * FROM users WHERE email = '$correo' AND AES_DECRYPT(password,'claveultrasecreta') = '$clave';";
         $resultado = mysqli_query($conexion, $query);
         if (mysqli_num_rows($resultado) == 1) {
            echo "se logeó con excito";
         } else {
            echo "nada mano";
         }
      }
   } catch (Throwable $t) {
      echo "<p>" . $t->getMessage() . "</p>";
      echo "<p>" . $t->getCode() . "</p>";
   }
} else {
   header("./../index.php");
   exit();
}
