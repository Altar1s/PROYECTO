<?php
$server = "localhost";
$usuario = "root";
$pass = "password";
$bbdd = "proyecto";
// $server = "sql106.infinityfree.com";
// $usuario = "if0_39101837";
// $pass = "DNjfksiqPWLBGn";
// $bbdd = "if0_39101837_tegami_ddbb";
$conexion = mysqli_connect($server, $usuario, $pass, $bbdd);
if (!$conexion) {
   die("Error de conexión: " . mysqli_connect_error());
}
mysqli_query($conexion, "SET NAMES UTF8");

function getConnection()
{
   global $conexion;
   return $conexion;
}

function getBBDD()
{
   global $bbdd;
   return $bbdd;
}
