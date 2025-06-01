<?php
if (session_status() === PHP_SESSION_NONE) {
   session_start();
}
if (isset($_SESSION["logged"])) {
   header("Location: index.php?page=home");
   exit;
}
?>

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