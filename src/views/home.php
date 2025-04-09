<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./assets/CSS/output.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <script type="module" src="./src/scripts/cargar_contenido.js"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   <title>Página de bienvenida</title>
</head>

<body class="flex flex-col min-h-screen">
   <?php
   require_once __DIR__ . "/../includes/config.php";
   require_once __DIR__ . "/../includes/navbar.php";
   ?>
   <main id="main" class="flex flex-auto bg-gray-100 p-4">
      <div class="container flex mx-auto flex-auto">
         <div class="max-w-5xl bg-gray-100 rounded-md mx-auto flex-auto flex flex-col">
            <?php
            if (isset($_SESSION['logged'])) {
               if ($_SESSION['rol'] == 'admin') {
            ?>
                  <div class="p-4 bg-white rounded-lg shadow mb-5 mt-2">
                     <h1 class="mb-4 text-3xl font-medium">Crear publicación</h1>
                     <form action="./../models/publicacionModel.php" method="post" enctype="multipart/form-data">
                        <div class="flex flex-col">
                           <input
                              type="hidden"
                              name="user_id"
                              value="<?php echo $_SESSION["user_id"] ?>">
                           <input
                              class="p-1 mb-3 border border-gray-300 rounded"
                              name="titulo"
                              type="text"
                              placeholder="Título">
                           <textarea
                              class="p-1 h-46 mb-3 resize-none border border-gray-300 rounded"
                              name="contenido"
                              placeholder="Contenido">
                        </textarea>
                           <input
                              name="imagenes[]"
                              type="file"
                              multiple
                              accept=".jpg, .jpeg, .png"
                              class="block text-sm text-gray-600 border border-gray-300 rounded p-1 mb-3 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:cursor-pointer hover:file:bg-gray-200 focus:border-gray-600">
                           <input
                              type="submit"
                              name="enviar"
                              value="Publicar"
                              class=" inline-block py-2 px-4 bg-gray-800 text-white font-semibold border border-gray-700 rounded-md hover:cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-gray-500 transition duration-150 ease-in-out">
                        </div>
                     </form>
                  </div>
               <?php
               } else {
               ?>
                  <div class="flex gap-4 ">
                     <button id="btn_publicaciones" class=" flex-1 py-3 px-6 bg-white text-slate-700  text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
                        Publicaciones
                     </button>
                     <button id="btn_grupos" class=" flex-1 py-2.5 px-6 bg-white text-slate-500 text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
                        Grupos
                     </button>
                  </div>
               <?php
               }
            } else {
               ?>
               <div class="">
                  <h1 class="">

                  </h1>
               </div>
            <?php
            }
            ?>
            <div class="bg-gray-200 rounded-b-lg flex-auto flex">
               <div class="flex-auto flex flex-col py-4 px-3 bg-white rounded-b-lg" id="contenido">

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