<?php
$server = "localhost";
$usuario = "root";
$pass = "password";
$bbdd = "proyecto";
$conexion = mysqli_connect($server, $usuario, $pass, $bbdd);
if (!$conexion) {
   die("Error de conexión: " . mysqli_connect_error());
}
mysqli_query($conexion, "SET NAMES UTF8");
