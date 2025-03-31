<?php
if (isset($_POST["enviar"])) {
   extract($_POST);
   try {
      require("./../includes/conexion.php");
      $titulo = mysqli_real_escape_string($conexion, $titulo);
      $contenido = mysqli_real_escape_string($conexion, $contenido);
      if (mysqli_select_db($conexion, $bbdd)) {
         $query = "SELECT * FROM admins WHERE user_id = $user_id";
         $resultado = mysqli_fetch_array(mysqli_query($conexion, $query));
         $admin_id = $resultado["id"];
         $query = "INSERT INTO publicaciones (admin_id,contenido,titulo) VALUES($admin_id,'$contenido','$titulo');";
         mysqli_query($conexion, $query);
         header("Location: ./../../index.php?status=success");
         exit();
      }
   } catch (Throwable $t) {
      echo "<p>" . $t->getMessage() . "</p>";
      echo "<p>" . $t->getCode() . "</p>";
   }
} else {
   header("Location: ./../../index.php?status=error");
   exit();
}
