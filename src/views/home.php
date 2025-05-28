<div id="contenido" class="overflow-hidden flex flex-1 gap-2 min-h-0 py-2 sm:py-4 px-2 sm:px-4 md:px-6 lg:px-8 bg-[#fcfcfc] rounded-b-lg rounded-tl-lg">
   <?php require __DIR__ . "/partials/publications.php" ?>
</div>
<div id="modal-container">
   <?php if (isset($_GET["status"]) && $_GET["status"] == "error"): ?>
      <div class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
         <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-red-200">
            <h2 class="text-xl font-semibold text-red-600 mb-2">Error de credenciales</h2>
            <p class="text-sm text-gray-700 mb-4">El usuario o la contraseña que has introducido no son correctos. Por favor, inténtalo de nuevo.</p>
            <div class="flex justify-end">
               <a href="<?= URL ?>">
                  <button class="px-4 py-2 rounded bg-red-600 text-white text-sm font-medium hover:bg-red-700 transition-colors shadow-sm hover:cursor-pointer">
                     Cerrar
                  </button>
               </a>
            </div>
         </div>
      </div>
   <?php endif ?>
</div>