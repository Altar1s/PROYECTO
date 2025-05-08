<div class="flex-1 overflow-y-auto px-3">
   <div class="py-4 space-y-4">
      <?php foreach ($publications_data as $publication): ?>
         <div class="shadow bg-orange-100 rounded-lg p-4">
            <h2 class="text-lg text-black font-semibold"><?php echo $publication["titulo"] ?></h2>
            <p class="text-gray-700"><?php echo $publication["contenido"] ?></p>
            <div class="flex gap-2">
               <?php if (strlen($publication["img"]) > 0): ?>
                  <?php
                  $imagenes = explode(",", $publication["img"]);
                  array_pop($imagenes);
                  ?>
                  <?php foreach ($imagenes as $img): ?>
                     <img src="./media/img/<?php echo $img ?>" class="flex-1 overflow-hidden w-auto h-auto rounded-lg mt-4">
                  <?php endforeach ?>
               <?php endif ?>
            </div>
         </div>
      <?php endforeach ?>
   </div>
</div>