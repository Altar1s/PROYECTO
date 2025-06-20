<div id="addModal" class="select2 modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
   <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-gray-100">
      <h2 class="text-2xl font-semibold text-gray-800 mb-1">
         <?php
         if ($isAddModal) {
            echo "Crear nuevo " . $entity;
         } else {
            echo "Editar " . $entity;
         }
         ?>
      </h2>
      <p class="text-sm text-gray-500 mb-6">Introduce la información</p>
      <form class="form space-y-4">
         <input type="hidden" name="type" value="<?php echo ($isAddModal) ? "addEntity" : "editEntity" ?>">
         <input type="hidden" name="entity" value="<?= $entity ?>">
         <?php if (!$isAddModal): ?>
            <input type="hidden" name="id" value="<?= $dataEntity["id"] ?>">
         <?php endif ?>
         <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input value="<?php echo ($dataEntity["nombre"] ?? "") ?>" type="text" id="nombre" name="nombre" required
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800 bg-white shadow-sm">
         </div>
         <div>
            <label for="profesor" class="block text-sm font-medium text-gray-700 mb-1">Profesor</label>
            <div class="relative">
               <select id="busqueda" name="profesor" required
                  class="w-full appearance-none px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800 bg-white shadow-sm pr-10">
                  <?php foreach ($professors as $professor): ?>
                     <option class="px-4 py-2" value="<?php echo $professor["id"] ?>" <?php echo ($dataEntity['profesor_id'] ?? null) == $professor['id'] ? 'selected' : ''; ?>>
                        <?php echo $professor["nombre"] . " " . $professor["apellidos"] ?>
                     </option>
                  <?php endforeach ?>
               </select>
            </div>
         </div>
         <div class="flex justify-end gap-3 pt-4">
            <button type="submit"
               class="hover:cursor-pointer px-4 py-2 rounded text-sm bg-emerald-600 text-white hover:bg-emerald-700 transition-colors shadow-sm">
               Guardar
            </button>
            <button type="button" id="cancel-action"
               class="hover:cursor-pointer px-4 py-2 rounded text-sm bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors shadow-sm">
               Cancelar
            </button>
         </div>
      </form>
   </div>
</div>