<div class="flex-1 flex flex-col mt-4">
   <div class="overflow-y-auto max-h-70 border border-gray-300 rounded shadow-md">
      <table class="min-w-full">
         <thead class="bg-gray-800 text-white sticky top-0">
            <tr>
               <th class="px-4 py-2 flex justify-between items-center">
                  <span class="flex align-middle">Nombre</span>
                  <button id="add-btn" data-entity="<?php echo $_GET["type"] ?>" class="bg-emerald-200 hover:bg-emerald-300 text-emerald-900 px-3 py-1 rounded transition-colors duration-300 ease-in-out hover:cursor-pointer shadow-sm">
                     Agregar
                  </button>
               </th>
            </tr>
         </thead>
         <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach ($list as $data): ?>
               <tr class="text-gray-700">
                  <td class="px-4 py-2">
                     <div class="flex items-center justify-between">
                        <span><?php echo $data["nombre"] . " " . ($data["apellidos"] ?? "") ?></span>
                        <div class="flex gap-2">
                           <button data-entity-id="<?php echo $data["id"] ?>" data-entity="<?php echo $_GET["type"] ?>" data-action="eliminar" class="btn-delete bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded transition-colors duration-300 ease-in-out hover:cursor-pointer">
                              Eliminar
                           </button>
                           <button class="bg-gray-800 hover:bg-zinc-600 text-white px-3 py-1 rounded transition-colors duration-300 ease-in-out hover:cursor-pointer">
                              Editar
                           </button>
                        </div>
                     </div>
                  </td>
               </tr>
            <?php endforeach ?>

         </tbody>
      </table>
   </div>
</div>