<?php
if (isset($_POST["enviar"])) {
   extract($_POST);
   try {
      require("./../includes/conexion.php");
      //EVITAR INYECCION DE CODIGO
      $correo = mysqli_real_escape_string($conexion, $correo);
      $clave = mysqli_real_escape_string($conexion, $clave);
      //QUERY
      if (mysqli_select_db($conexion, $bbdd)) {
         $query = "SELECT * FROM users WHERE email = '$correo' AND AES_DECRYPT(password,'claveultrasecreta') = '$clave';";
         $resultado = mysqli_query($conexion, $query);
         if (mysqli_num_rows($resultado) == 1) {
            session_destroy();
            session_start();
            $resultado = mysqli_fetch_array($resultado);
            $_SESSION["logged"] = true;
            $_SESSION["user_id"] = $resultado["id"];
            $_SESSION["usuario"] = $resultado["email"];
            $_SESSION["rol"] = $resultado["rol"];
            $_SESSION["hora"] = time();
            header("Location: ./../../index.php?page=home");
            exit();
         } else {
            header("Location: ./../../index.php?status=error");
            exit();
         }
      }
   } catch (Throwable $t) {
      echo "<p>" . $t->getMessage() . "</p>";
      echo "<p>" . $t->getCode() . "</p>";
   }
} else {
   header("Location: ./../../index.php");
   exit();
}
