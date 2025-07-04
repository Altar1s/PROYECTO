<div id="addModal" class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50 ">
   <div class="bg-white p-6 rounded-lg shadow-2xl w-full max-w-sm border border-gray-200">
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
      <form class="form space-y-4" enctype="multipart/form-data">
         <input type="hidden" name="type" value="<?php echo ($isAddModal) ? "addEntity" : "editEntity" ?>">
         <input type="hidden" name="entity" value="<?php echo $entity ?>">
         <?php if (!$isAddModal): ?>
            <input type="hidden" name="user_id" value="<?= $dataEntity["id"] ?>">
         <?php endif ?>
         <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input value="<?php echo ($dataEntity["email"] ?? "") ?>" type="email" id="email" name="email" required
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
         </div>
         <?php if (!isset($dataEntity["nombre"])): ?>
            <div>
               <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
               <input type="password" id="password" name="password" required
                  class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
            </div>
         <?php endif ?>
         <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input value="<?php echo ($dataEntity["nombre"] ?? "") ?>"
               type="text"
               id="nombre"
               name="nombre"
               required
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
         </div>
         <div>
            <label for="apellidos" class="block text-sm font-medium text-gray-700 mb-1">Apellidos</label>
            <input value="<?php echo ($dataEntity["apellidos"] ?? "") ?>" type="text" id="apellidos" name="apellidos"
               required
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
         </div>
         <div>
            <span class="block w-full px-2 py-1 text-xs text-gray-500 font-medium bg-gray-100 rounded mb-1">
               Solo se admiten imágenes de hasta 10 MB
            </span>
            <input
               name="foto"
               type="file"
               accept=".jpg, .jpeg, .png"
               class="w-full block text-sm text-gray-600 border border-gray-300 rounded p-1 mb-3 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:cursor-pointer hover:file:bg-gray-200 focus:border-gray-600">
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