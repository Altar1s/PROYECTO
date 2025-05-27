<div class="space-y-3">
   <div class="flex justify-end">
      <button data-chat-id="<?= $chatId ?>" data-modaltype="add-student-to-chat" class="btn-show-modal bg-emerald-200 hover:bg-emerald-300 text-emerald-900 px-3 py-1 rounded transition-colors duration-300 ease-in-out hover:cursor-pointer shadow-sm">
         Agregar miembro
      </button>
   </div>
   <?php foreach ($members as $member): ?>
      <div class="flex items-center bg-white rounded-lg border border-gray-300 p-3 shadow-xs hover:shadow-md transition-shadow">
         <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden">
            <img src="<?php echo URL . "media/img/" . $member["foto"]; ?>" alt="Foto" class="w-full h-full object-cover">
         </div>
         <div class="ml-3 flex-1">
            <p class="text-gray-900 font-medium"><?php echo $member["nombre"] . " " . $member["apellidos"] ?></p>
         </div>
         <button data-type="show-grades" data-student-id="<?= $member['id'] ?>" data-chat-id="<?= $chatId ?>" class="btn-student-grades ml-auto bg-gray-800 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200">
            Cambiar nota
         </button>
      </div>
   <?php endforeach ?>
</div>