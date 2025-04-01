<?php
if (isset($_POST["enviar"])) {
   extract($_POST);
   try {
      require("./../includes/conexion.php");
      // gestionar imagenes 
      $imagenes = "";
      if (!empty($_FILES["imagenes"]["name"][0]) && count($_FILES["imagenes"]["name"]) < 5) {
         $path = "./../media/img/";
         foreach ($_FILES["imagenes"]["tmp_name"] as $key => $tmp_name) {
            $name = $_FILES["imagenes"]["name"][$key];
            $type = $_FILES["imagenes"]["type"][$key];
            $size = $_FILES["imagenes"]["size"][$key];
            if ($size > 10485760) {
               header("Location: ./../../index.php?error=size");
               exit();
            }
            if (!file_exists($path . $name)) {
               if (!move_uploaded_file($tmp_name, $path . $name)) {
                  header("Location: ./../../index.php?error=error_img");
                  exit();
               }
            } else {
               header("Location: ./../../index.php?error=img_exist");
               exit();
            }
            $imagenes .= $name . ",";
         }
      } else {
         $magenes = null;
      }
      // AGREGAR A LA BASE DE DATOS
      $titulo = mysqli_real_escape_string($conexion, $titulo);
      $contenido = mysqli_real_escape_string($conexion, $contenido);
      if (mysqli_select_db($conexion, $bbdd)) {
         $query = "SELECT * FROM admins WHERE user_id = $user_id";
         $resultado = mysqli_fetch_array(mysqli_query($conexion, $query));
         $admin_id = $resultado["id"];
         $query = "INSERT INTO publicaciones (admin_id,contenido,titulo,img) VALUES($admin_id,'$contenido','$titulo','$imagenes');";
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
