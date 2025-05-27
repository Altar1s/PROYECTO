<div class="flex-1">
   <div class="py-2 sm:py-4 space-y-3 sm:space-y-4">
      <?php foreach ($publications_data as $publication): ?>
         <div class="post bg-white border border-gray-200 rounded-lg p-3 sm:p-4 shadow-sm">
            <div class="editable-content"></div>
            <div class="text-content">
               <div class="flex justify-between items-start mb-2">
                  <h2 class="post-title text-base sm:text-lg font-semibold text-gray-800"><?= $publication["titulo"] ?></h2>
                  <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] == "admin"): ?>
                     <div class="post-actions flex gap-2">
                        <button data-post-title="<?= $publication["titulo"] ?>" data-post-content="<?= $publication["contenido"] ?>" data-id="<?= $publication["id"] ?>" data-type="edit"
                           class="edit-post hover:cursor-pointer text-xs sm:text-sm text-gray-600 hover:text-gray-800 transition-colors">
                           <i class="fas fa-edit"></i>
                        </button>
                        <button data-id="<?= $publication["id"] ?>" data-modaltype="delete-post"
                           class="btn-show-modal hover:cursor-pointer text-xs sm:text-sm text-gray-600 hover:text-red-600 transition-colors">
                           <i class="fas fa-trash-alt"></i>
                        </button>
                     </div>
                  <?php endif ?>
               </div>
               <p class="post-content text-gray-700 text-xs sm:text-sm mb-2"><?= $publication["contenido"] ?></p>
            </div>
            <?php if (strlen($publication["img"]) > 0): ?>
               <?php
               $imagenes = explode(",", $publication["img"]);
               array_pop($imagenes);
               ?>
               <div class="media grid grid-cols-2 sm:grid-cols-3 gap-2 mt-2 sm:mt-3">
                  <?php foreach ($imagenes as $img): ?>
                     <img src="./media/img/<?= $img ?>" class="w-full h-auto rounded-md object-cover">
                  <?php endforeach ?>
               </div>
            <?php endif ?>
         </div>
      <?php endforeach ?>
   </div>
</div>