<div id="addModal" class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50 ">
   <div class="bg-white p-6 rounded-lg shadow-2xl w-full max-w-sm border border-gray-200">
      <h2 class="text-2xl font-semibold text-gray-800 mb-1">Crear nuevo <?php echo $_POST["entity"] ?></h2>
      <p class="text-sm text-gray-500 mb-6">Introduce la información</p>
      <form id="addForm" class="space-y-4">
         <div>
            <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
            <input type="text" id="nombre" name="nombre" required
               class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
         </div>
         <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" id="email" name="email" required
               class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800">
         </div>
         <div class="flex justify-end gap-3 pt-4">
            <button type="button" id="cancel-action"
               class="hover:cursor-pointer px-4 py-2 rounded-xl text-sm bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors">
               Cancelar
            </button>
            <button type="submit"
               class="hover:cursor-pointer px-4 py-2 rounded-xl text-sm bg-emerald-600 text-white hover:bg-emerald-700 transition-colors shadow">
               Guardar
            </button>
         </div>
      </form>
   </div>
</div>