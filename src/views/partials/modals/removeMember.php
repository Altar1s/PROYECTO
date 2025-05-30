<div id="deleteModal" class="modal fixed inset-0 bg-gray-900/40 backdrop-blur-sm flex items-center justify-center z-50 transition-opacity duration-300">
   <div class="bg-white rounded-2xl shadow-2xl text-center max-w-sm w-full border border-gray-200 p-6 animate-fadeIn">
      <h2 class="text-2xl font-bold text-slate-800 mb-4">¿Estás seguro?</h2>
      <p class="text-slate-600 mb-6 text-sm">Esta acción eliminará al miembro del grupo.</p>
      <div class="flex justify-center gap-3">
         <button data-type="remove-member" data-chat-id="<?= $chatId ?>" data-student-id="<?= $studentId ?>" id="confirm-remove-member" class="bg-red-600 text-white px-5 py-2.5 rounded-full hover:bg-red-700 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-red-300 hover:cursor-pointer">
            Eliminar
         </button>
         <button id="cancel-action" class="bg-slate-100 text-slate-700 px-5 py-2.5 rounded-full hover:bg-slate-200 transition-all duration-300 shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-slate-300 hover:cursor-pointer">
            Cancelar
         </button>
      </div>
   </div>
</div>