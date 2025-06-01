<?php
require_once __DIR__ . "/../includes/session.php";
?>
<div class="flex gap-4 justify-end">
   <button class="shadow-xs  py-3 px-6 bg-[#fcfcfc] text-slate-700  text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
      Perfil
   </button>
</div>
<div id="profile-container" class="flex flex-1 flex-col min-h-0 py-4 px-6 bg-[#fcfcfc] rounded-b-lg rounded-tl-lg shadow-xs">
   <div class="flex flex-col items-center rounded-lg space-y-4 mb-4">
      <div class="w-60 h-60 rounded-full overflow-hidden">
         <img src="<?php echo URL . 'media/img/' . $userData['foto']; ?>" alt="Foto de perfil" class="w-full h-full object-cover">
      </div>
      <div class="w-full space-y-1 text-gray-800">
         <p class="font-semibold"><span class="text-gray-500">Nombre: </span><?php echo $rolData['nombre'] ?></p>
         <p class="font-semibold"><span class="text-gray-500">Apellidos: </span><?php echo $rolData['apellidos'] ?></p>
         <p class="font-semibold"><span class="text-gray-500">Correo: </span><?php echo $userData['email'] ?></p>
      </div>
      <div class="flex w-full flex-col sm:flex-row justify-start gap-2 ">
         <button
            data-modaltype="change-password" class="btn-show-modal bg-yellow-500 py-2 px-4  text-gray-900 font-semibold rounded-lg hover:bg-yellow-600 cursor-pointer hover:ring-2 hover:ring-yellow-400 transition duration-150 ease-in-out shadow-sm">Cambiar contraseña</button>
         <form method="post" action="./src/models/profileOptions.php">
            <input
               class="bg-red-500 text-white w-full py-2 px-4 rounded-lg font-semibold transition duration-150 ease-in-out hover:bg-red-600 hover:ring-2 hover:ring-red-400 cursor-pointer shadow-sm"
               type="submit"
               value="Cerrar Sesión"
               name="cerrar">
         </form>
      </div>
   </div>
   <?php
   if ($_SESSION["rol"] == "admin") {
      require __DIR__ . "/partials/optionsProfileAdmin.php";
   }
   ?>
   <div id="table-data">
      <?php
      if ($_SESSION["rol"] == "estudiante") {
         require __DIR__ . "/partials/profileTable.php";
      } else if ($_SESSION["rol"] == "admin") {
         require __DIR__ . "/partials/tableAdmin.php";
      }
      ?>
   </div>
   <div id="modal-container">

   </div>
   <div id="request-display-info">

   </div>
</div>