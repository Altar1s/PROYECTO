<div class="form modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
   <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-gray-100">
      <h2 class="text-2xl font-semibold text-gray-800 mb-1">Cambia tu contraseña</h2>
      <form class="form space-y-4">
         <input type="hidden" name="type" value="change-password">
         <div>
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Introduce tu contraseña actual:</label>
            <input type="password" name="currentPass"
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800 placeholder-gray-400">
         </div>
         <div>
            <label for="" class="block text-sm font-medium text-gray-700 mb-1">Introduce tu nueva contraseña:</label>
            <input type="password" name="newPass"
               class="w-full px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-800 focus:border-gray-800 transition-all text-sm text-gray-800 placeholder-gray-400">
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