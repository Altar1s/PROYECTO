<div id="deleteModal" class="modal fixed inset-0 bg-gray-900/30 flex backdrop-blur-sm items-center justify-center z-50 ">
   <div class="bg-white p-6 rounded-xl shadow-2xl text-center max-w-sm w-full border border-gray-200">
      <h2 class="text-xl font-semibold text-gray-800 mb-3">¿Estás seguro?</h2>
      <p class="text-gray-600 mb-5 text-sm">Esta acción eliminará el registro de forma permanente. Esta acción no se puede deshacer.</p>
      <div class="flex justify-center gap-4">
         <button data-id="<?= $id ?>" data-entity="<?= $entity ?>" id="confirm-delete" class="bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700 transition-colors duration-300 shadow-sm hover:cursor-pointer">
            Eliminar
         </button>
         <button id="cancel-action" class="bg-gray-100 text-gray-700 px-5 py-2 rounded-lg hover:bg-gray-200 transition-colors duration-300 shadow-sm hover:cursor-pointer">
            Cancelar
         </button>
      </div>
   </div>
</div>