<div class="flex gap-4 justify-end">
   <button class="shadow-xs  py-3 px-6 bg-white text-slate-700  text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
      Perfil
   </button>
</div>
<div id="content" class="flex flex-1 flex-col min-h-0 py-4 px-6 bg-white rounded-b-lg rounded-tl-lg shadow-xs">
   <div class="flex flex-col items-center bg-white rounded-lg space-y-4 mb-4">
      <div class="w-60 h-60 rounded-full overflow-hidden">
         <img src="<?php echo URL . 'media/img/' . $userData['foto']; ?>" alt="Foto de perfil" class="w-full h-full object-cover">
      </div>
      <div class="w-full space-y-1 text-gray-800">
         <p class="font-semibold"><span class="text-gray-500">Nombre: </span><?php echo $rolData['nombre'] ?></p>
         <p class="font-semibold"><span class="text-gray-500">Apellidos: </span><?php echo $rolData['apellidos'] ?></p>
         <p class="font-semibold"><span class="text-gray-500">Correo: </span><?php echo $userData['email'] ?></p>
      </div>
      <form class="w-full flex justify-start" method="post" action="./src/models/logoutModel.php">
         <input class="bg-red-500 text-white py-2 px-4 rounded-lg font-semibold transition duration-150 ease-in-out hover:bg-red-600 hover:ring-2 hover:ring-red-400 hover:cursor-pointer" type="submit" value="Cerrar Sesión" name="cerrar">
      </form>
   </div>
   <?php
   if ($_SESSION["rol"] == "estudiantes") {
      require __DIR__ . "./partials/profileTable.php";
   }
   ?>
</div>