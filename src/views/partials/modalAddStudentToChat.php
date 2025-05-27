<div class="modal select2 fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">
   <div class="bg-white rounded-2xl shadow-2xl w-full max-w-sm border border-gray-200 p-6 animate-fadeIn">
      <h2 class="text-2xl font-bold text-slate-800 mb-1">Agregar un estudiante</h2>
      <p class="text-slate-600 mb-4 text-sm">Agrega un estudiante al grupo</p>
      <form id="add-student-to-chat" class="space-y-4">
         <div>
            <input type="hidden" name="type" value="addStudentToChat">
            <input type="hidden" name="chatId" value="<?= $chatId ?>">
            <label for="busqueda" class="block text-sm font-medium text-slate-700 mb-1">Selecciona una opción</label>
            <select id="busqueda" name="studentId"
               class="w-full rounded-xl border border-gray-300 text-sm text-slate-800 shadow-sm focus:ring-2 focus:ring-slate-800 focus:border-slate-800 transition-all">
               <?php foreach ($data as $students): ?>
                  <option value="<?= $students["id"] ?>"><?= $students["nombre"] . " " . $students["apellidos"] ?></option>
               <?php endforeach ?>
            </select>
         </div>
         <div class="flex justify-end gap-3 pt-4">
            <button type="button" id="cancel-action"
               class="bg-slate-100 text-slate-700 px-4 py-2.5 rounded-full hover:bg-slate-200 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-300 hover:cursor-pointer">
               Cancelar
            </button>
            <button type="submit"
               class="bg-emerald-600 text-white px-4 py-2.5 rounded-full hover:bg-emerald-700 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-emerald-300 hover:cursor-pointer">
               Agregar
            </button>
         </div>
      </form>
   </div>
</div>