<?php
function fetchAll($result)
{
   $data = [];
   while ($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
   }
   return $data;
}

function selectDB(mysqli $conexion, string $bbdd)
{
   return mysqli_select_db($conexion, $bbdd);
}

function getAllEntities(mysqli $conexion, string $bbdd, string $table)
{
   if (!selectDB($conexion, $bbdd)) return [];
   $query = "SELECT * FROM $table";
   $result = mysqli_query($conexion, $query);
   return fetchAll($result);
}

function fetchOne(mysqli $conexion, string $bbdd, string $query)
{
   if (!selectDB($conexion, $bbdd)) return null;
   $result = mysqli_query($conexion, $query);
   $data = mysqli_fetch_assoc($result);
   return $data ?: null;
}
