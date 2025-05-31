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
   <?php elseif (isset($_GET["status"]) && $_GET["status"] == "caducado"): ?>
      <div class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
         <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-yellow-200">
            <h2 class="text-xl font-semibold text-yellow-600 mb-2">Sesión caducada</h2>
            <p class="text-sm text-gray-700 mb-4">Tu sesión ha caducado por inactividad o expiración. Por favor, vuelve a iniciar sesión para continuar.</p>
            <div class="flex justify-end">
               <a href="<?= URL ?>">
                  <button class="px-4 py-2 rounded bg-yellow-500 text-white text-sm font-medium hover:bg-yellow-600 transition-colors shadow-sm hover:cursor-pointer">
                     Cerrar
                  </button>
               </a>
            </div>
         </div>
      </div>
   <?php elseif (isset($_GET["status"]) && $_GET["status"] == "inactividad"): ?>
      <div class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
         <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-orange-200">
            <h2 class="text-xl font-semibold text-orange-600 mb-2">Inactividad detectada</h2>
            <p class="text-sm text-gray-700 mb-4">Hemos detectado que llevas un tiempo inactivo. Por favor, vuelve a iniciar sesión para continuar.</p>
            <div class="flex justify-end">
               <a href="<?= URL ?>">
                  <button class="px-4 py-2 rounded bg-orange-500 text-white text-sm font-medium hover:bg-orange-600 transition-colors shadow-sm hover:cursor-pointer">
                     Cerrar
                  </button>
               </a>
            </div>
         </div>
      </div>
   <?php elseif (isset($_GET["status"]) && $_GET["status"] == "nologged"): ?>
      <div class="modal fixed inset-0 bg-gray-900/30 backdrop-blur-sm flex items-center justify-center z-50">
         <div class="bg-white p-6 rounded-2xl shadow-2xl w-full max-w-sm border border-red-200">
            <h2 class="text-xl font-semibold text-red-600 mb-2">Acceso no autorizado</h2>
            <p class="text-sm text-gray-700 mb-4">Debes iniciar sesión para acceder a esta sección. Por favor, inicia sesión para continuar.</p>
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