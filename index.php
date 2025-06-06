<?php
require_once __DIR__ . "/src/includes/config.php";
require_once __DIR__ . "/src/includes/conexion.php";
?>
<!DOCTYPE html>
<html lang="es" class="h-full">

<head>
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="./assets/CSS/output.css" rel="stylesheet" />
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <link rel="icon" href="./assets/img/logo.png">
   <script type="module" src="./src/scripts/main.js"></script>
   <!-- CSS y JS de Select2 -->
   <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
   <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
   <title><?php echo htmlspecialchars($_GET["page"] ?? "Log in"); ?></title>
</head>

<body class="flex flex-col min-h-screen bg-gray-100 text-gray-800">
   <?php
   if (session_status() === PHP_SESSION_NONE) {
      session_start();
   }

   require_once __DIR__ . "/src/views/partials/navbar.php";

   $page = preg_replace('/[^a-zA-Z0-9_-]/', '', $_GET["page"] ?? "Log in");
   ?>

   <main id="main" class="flex flex-col flex-1 container mx-auto px-4 py-6 max-w-7xl" data-rol="<?php echo htmlspecialchars($_SESSION["rol"] ?? ''); ?>">
      <?php
      switch ($page) {
         case "home":
            require_once __DIR__ . "/src/controllers/homeController.php";
            showHomePage($conexion, $bbdd);
            break;
         case "perfil":
            require_once __DIR__ . "/src/controllers/perfilController.php";
            showProfilePage($conexion, $bbdd, $_SESSION["user_id"]);
            break;
         case "Login":
            if (session_status() == PHP_SESSION_NONE) {
               session_start();
            }
            if (isset($_SESSION["logged"]) && !isset($_GET["page"])) {
               header("Location: ./index.php?page=home");
               exit;
            }
            require_once __DIR__ . "/src/views/login.php";
            break;
         default:
            echo "<h1 class='text-2xl font-semibold text-center text-red-600'>404 - Página No Encontrada</h1>";
            break;
      }
      ?>
   </main>

   <?php require_once __DIR__ . "/src/views/partials/footer.php"; ?>
</body>

</html>