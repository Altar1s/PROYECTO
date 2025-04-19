<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./assets/CSS/output.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title><?php echo $_GET["page"] ?? "home"  ?></title>
</head>

<body class="flex flex-col min-h-screen">
   <?php
   session_start();
   require_once __DIR__ . "/src/includes/config.php";
   require_once __DIR__ . "/src/includes/conexion.php";
   require_once __DIR__ . "/src/includes/auth.php";
   require_once __DIR__ . "/src/views/partials/navbar.php";
   ?>
   <main id="main" class="flex flex-1 bg-gray-100 p-4 overflow-hidden">
      <div class="flex flex-col flex-1 container mx-auto lg:max-w-5xl  ">
         <?php
         $page = $page = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET["page"] ?? "home"); //PARA EVITAR ATAQUES DE INYECCION DE CODIGO
         switch ($page) {
            case "home":
               require_once __DIR__ . "/src/controllers/homeController.php";
               showHomePage();
               break;
            case "perfil":
               require_once __DIR__ . "/src/controllers/perfilController.php";
               authLogged();
               showProfilePage($conexion, $bbdd, $_SESSION["user_id"]);
               break;
            default:
               echo "<h1>404 - Página No Encontrada</h1>";
               break;
         }
         ?>
      </div>
   </main>
   <?php
   require_once __DIR__ . "/src/views/partials/footer.php";
   ?>
</body>