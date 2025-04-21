<div class="flex gap-4 justify-end ">
   <button id="" class=" py-3 px-6 bg-white text-slate-700  text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
      Perfil
   </button>
   <button id="" class=" py-3 px-6 bg-white text-slate-700  text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
      <?php echo $tab ?>
   </button>
</div>
<div id="content" class="flex flex-1 flex-col gap-2 py-4 px-3 bg-white rounded-b-lg rounded-tl-lg shadow">
   <div class="flex rounded-lg shadow">
      <div class="lg:w-100 lg:h-100 md:w-50 md:h-50 w-32 h-32 rounded-full overflow-hidden">
         <img src="<?php echo URL . 'media/img/' . $userData['foto']; ?>" alt="Foto de perfil" class="w-full h-full">
      </div>
      <div class="flex flex-col px-2 py-4">
         <div class="flex-1">
            <p><span>Nombre: </span><?php echo $rolData['nombre'] ?></p>
            <p><span>Apellidos: </span><?php echo $rolData['apellidos'] ?></p>
            <p><span>Correo: </span><?php echo $userData['email'] ?></p>
         </div>
         <form class="flex items-center mr-2" method="post" action="./src/models/logoutModel.php">
            <input class="bg-red-500 hover:bg-red-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer" type="submit" value="Cerrar Sesión" name="cerrar">
         </form>
      </div>
   </div>
</div>