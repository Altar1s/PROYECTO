<div class="flex flex-col items-center justify-center min-h-[70vh] px-2 sm:px-4">
   <div class="bg-white rounded-2xl shadow-lg w-full max-w-md p-4 sm:p-6 md:p-8 border border-gray-200">
      <h1 class="text-2xl font-semibold text-center text-gray-800 mb-4 sm:mb-6">Iniciar sesión</h1>
      <form method="POST" action="<?php echo URL ?>src/models/loginModel.php" class="space-y-4">
         <div>
            <label class="block text-sm font-medium text-gray-700">Usuario</label>
            <input type="email" name="correo" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-yellow-400 focus:border-yellow-400 transition duration-150 ease-in-out" />
         </div>
         <div>
            <label class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="clave" required
               class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:ring-yellow-400 focus:border-yellow-400 transition duration-150 ease-in-out" />
         </div>
         <div>
            <input type="submit" name="enviar" value="Iniciar Sesión"
               class="hover:cursor-pointer w-full flex justify-center py-2 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-yellow-500 hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 transition duration-150 ease-in-out">
            </input>
         </div>
      </form>
   </div>
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