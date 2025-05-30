<div class="space-y-3">
   <div class="flex justify-end">
      <button data-chat-id="<?= $chatId ?>" data-modaltype="add-student-to-chat" class="btn-show-modal bg-emerald-200 hover:bg-emerald-300 text-emerald-900 px-3 py-1 rounded transition-colors duration-300 ease-in-out hover:cursor-pointer shadow-sm">
         Agregar miembro
      </button>
   </div>
   <?php foreach ($members as $member): ?>
      <div class="flex flex-col items-start md:flex-row  md:items-center bg-white rounded-lg border border-gray-300 p-3 shadow-xs hover:shadow-md transition-shadow">
         <div class="flex items-center">
            <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden">
               <img src="<?php echo URL . "media/img/" . $member["foto"]; ?>" alt="Foto" class="w-full h-full object-cover">
            </div>
            <div class="ml-3 flex-1">
               <p class="text-gray-900 font-medium"><?php echo $member["nombre"] . " " . $member["apellidos"] ?></p>
            </div>
         </div>
         <div class="flex flex-wrap sm:flex-nowrap sm:flex-row w-full sm:w-auto mt-1 sm:mt-0 sm:ml-auto gap-2">
            <button
               data-type="show-grades"
               data-student-id="<?= $member['id'] ?>"
               data-chat-id="<?= $chatId ?>"
               class="min-w-[150px] flex-1 sm:w-auto btn-student-grades  bg-gray-800 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200">
               Cambiar nota
            </button>
            <button
               data-modaltype="remove-member"
               data-student-id="<?= $member['id'] ?>"
               data-chat-id="<?= $chatId ?>"
               class="min-w-[150px] flex-1 sm:w-auto btn-show-modal bg-red-500 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-red-600 hover:cursor-pointer transition-colors duration-200">
               Eliminar miembro
            </button>
         </div>
      </div>
   <?php endforeach ?>
</div>