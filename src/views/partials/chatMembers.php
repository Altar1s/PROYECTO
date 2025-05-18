<div class="space-y-3">
   <?php foreach ($members as $member): ?>
      <div class="flex items-center bg-white rounded-lg border border-gray-300 p-3 shadow-xs hover:shadow-md transition-shadow">
         <div class="flex-shrink-0 w-12 h-12 rounded-full overflow-hidden">
            <img src="<?php echo URL . "media/img/" . $member["foto"]; ?>" alt="Foto" class="w-full h-full object-cover">
         </div>
         <div class="ml-3 flex-1">
            <p class="text-gray-900 font-medium"><?php echo $member["nombre"] . " " . $member["apellidos"] ?></p>
         </div>
         <button data-student-id="<?php echo $member['id'] ?>" class="btn-student-grades ml-auto bg-gray-800 text-white text-sm font-semibold py-2 px-4 rounded-lg hover:bg-gray-700 hover:cursor-pointer transition-colors duration-200">
            Cambiar nota
         </button>
      </div>
   <?php endforeach ?>
</div>