<?php
header("Content-Type: application/json");
session_start();
$response = ["isActive" => true];

if (isset($_SESSION["hora"]) && ($_SESSION["hora"] + 3600) < time()) {
   session_destroy();
   $response = ["isActive" => false, "href" => "./index.php?status=caducado"];
   echo json_encode($response);
   exit;
}

if (isset($_SESSION["timeout"])) {
   $vida_sesion = time() - $_SESSION["timeout"];
   if ($vida_sesion > 900) {
      session_destroy();
      $response = ["isActive" => false, "href" => "./index.php?status=inactividad"];
      echo json_encode($response);
      exit;
   }
}

$_SESSION["timeout"] = time();
echo json_encode($response);
