<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./src/CSS/output.css" rel="stylesheet">
   <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
   <script type="module" src="./src/Scripts/cargar_contenido.js"></script>
   <title>Document</title>
</head>

<body class="flex flex-col min-h-screen">
   <nav class="bg-gray-800 flex p-2 justify-between">
      <div class="flex items-center gap-2">
         <img class="logo" src="./src/media/img/logo.png" alt="">
         <span class="text-lg font-semibold text-white">Tegami</span>
      </div>
      <?php session_start();
      if (!isset($_SESSION["logged"])): ?>
         <form class="flex items-center mr-2" action="./src/controllers/validacion.php" method="post">
            <div class="mr-2">
               <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3 " type="email" name="correo" placeholder="Usuario">
            </div>
            <div class="mr-2">
               <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3" type="password" name="clave" placeholder="Contraseña">
            </div>
            <input class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer" type="submit" name="enviar" value="Iniciar Sesión">
         </form>
      <?php else: ?>
         <form class="flex items-center mr-2" method="post" action="./src/controllers/cerrar_sesion.php">
            <input class="bg-red-500 hover:bg-red-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer" type="submit" value="Cerrar Sesión" name="cerrar">
         </form>
      <?php endif ?>
   </nav>

   <main id="main" class="flex-auto bg-gray-100 p-4">
      <div class="container bg-gray-100 rounded-md mx-auto">
         <?php
         if (isset($_SESSION['logged'])) {
            if ($_SESSION['rol'] == 'admin') {
         ?>
               <div class="p-4 bg-white rounded-lg shadow mb-5 mt-2">
                  <h1 class="mb-4 text-3xl font-medium">Crear publicación</h1>
                  <form action="./src/controllers/agregar_publicacion.php" method="post" enctype="multipart/form-data">
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
                           name=" archivos[]"
                           type="file"
                           multiple
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
               <div class="flex gap-4 mb-5">
                  <button id="btn_publicaciones" class="
                  flex-auto
                  py-3 px-6
                  bg-white
                  text-slate-700 
                  text-sm font-semibold
                  border border-slate-200 
                  rounded-lg
                  hover:cursor-pointer
                  hover:bg-slate-50   
                  hover:border-slate-300 
                  focus:outline-none
                  transition-all duration-150 ease-in-out
               ">
                     Publicaciones
                  </button>
                  <button id="btn_grupos" class=" flex-auto py-2.5 px-6 bg-white text-slate-700 text-sm font-semibold border border-slate-200 rounded-lg hover:cursor-pointer hover:bg-slate-50 hover:border-slate-300 focus:outline-none transition-all duration-150 ease-in-out
                  ">
                     Grupos
                  </button>
               </div>
         <?php
            }
         }
         ?>
         <div id="contenido">

         </div>
      </div>
   </main>

   <footer class="bg-gray-800 text-white p-4 text-center">
      wa
   </footer>
</body>


</html>