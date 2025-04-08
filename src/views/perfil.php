<!DOCTYPE html>

<html lang="es">

<head>
   <?php require_once __DIR__ . "/../includes/config.php"; ?>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
   <link href="<?php echo URL ?>assets/CSS/output.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="flex flex-col min-h-screen">
   <?php
   require_once __DIR__ . "/../includes/navbar.php";
   ?>
   <main class="flex-auto bg-gray-100 p-4">
      <div class="container mx-auto">
         <div class="max-w-7xl bg-gray-100 rounded-md mx-auto">
            <div class="flex p-4 bg-white rounded-lg mb-5 mt-2">
               <div>
                  <img src="" alt="">
               </div>
               <div>
                  <form class="flex items-center mr-2" method="post" action="./src/models/logoutModel.php">
                     <input class="bg-red-500 hover:bg-red-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer" type="submit" value="Cerrar Sesión" name="cerrar">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </main>
   <?php
   require_once __DIR__ . "/../includes/footer.php";
   ?>
</body>

</html>