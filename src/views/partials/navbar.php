<nav class="bg-gray-800 sticky top-0 left-0 shadow z-50">
   <div class="container mx-auto px-4 py-2 max-w-7xl flex justify-between items-center">
      <a href="<?php echo URL ?>" class="flex items-center gap-2 cursor-pointer">
         <img src="<?php echo URL ?>assets/img/logo.png" alt="Logo" class="h-15 w-auto"> <!-- h-15 más grande -->
         <span class="text-white font-semibold text-lg">Tegami</span>
      </a>
      <div class="hidden md:flex items-center gap-6">
         <a href="<?php echo URL ?>" class="<?= isset($_GET["page"]) ? "text-white" : "text-yellow-500" ?> font-medium hover:text-yellow-500 transition cursor-pointer">Inicio</a>
         <?php if (!isset($_SESSION["logged"])): ?>
            <form class="flex items-center gap-2">
               <input
                  type="email"
                  name="correo"
                  placeholder="Usuario"
                  class="bg-gray-700 text-white border border-gray-600 rounded py-1 px-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition cursor-pointer">
               <input
                  type="password"
                  name="clave"
                  placeholder="Contraseña"
                  class="bg-gray-700 text-white border border-gray-600 rounded py-1 px-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition cursor-pointer">
               <input
                  type="submit"
                  name="enviar"
                  value="Iniciar Sesión"
                  class="bg-yellow-500 text-gray-900 font-semibold rounded py-1 px-3 hover:bg-yellow-600 cursor-pointer transition">
            </form>
         <?php else: ?>
            <a id="profile-btn" href="<?php echo URL ?>index.php?page=perfil" class="<?= isset($_GET["page"]) ? "text-yellow-500" : "text-white" ?> font-medium hover:text-yellow-500 transition cursor-pointer">Perfil</a>
         <?php endif ?>
      </div>
      <div class="md:hidden cursor-pointer">
         <button id="menu-toggle" class="text-white text-2xl focus:outline-none hover:text-yellow-500 transition cursor-pointer">
            <i class="fas fa-bars"></i>
         </button>
      </div>
   </div>
</nav>
<div id="mobile-menu" class="fixed top-0 right-0 w-64 h-full bg-gray-900 shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out z-50 p-4 flex flex-col gap-4">
   <div class="flex justify-end cursor-pointer">
      <button id="menu-close" class="text-white text-2xl focus:outline-none hover:text-yellow-500 transition cursor-pointer">
         <i class="fas fa-times"></i>
      </button>
   </div>
   <a href="<?php echo URL ?>" class="<?= isset($_GET["page"]) ? "text-white" : "text-yellow-500" ?> flex items-center gap-2 font-medium hover:text-yellow-500 transition cursor-pointer">
      <i class="fas fa-home text-lg"></i>
      <span>Inicio</span>
   </a>

   <?php if (!isset($_SESSION["logged"])): ?>
      <form class="flex flex-col gap-3 mt-2">
         <input
            type="email"
            name="correo"
            placeholder="Usuario"
            class="bg-gray-700 text-white border border-gray-600 rounded py-1 px-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition cursor-pointer">
         <input
            type="password"
            name="clave"
            placeholder="Contraseña"
            class="bg-gray-700 text-white border border-gray-600 rounded py-1 px-3 placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 transition cursor-pointer">
         <input
            type="submit"
            name="enviar"
            value="Iniciar Sesión"
            class="bg-yellow-500 text-gray-900 font-semibold rounded py-1 px-3 hover:bg-yellow-600 cursor-pointer transition">
      </form>
   <?php else: ?>
      <a id="profile-btn" href="<?php echo URL ?>index.php?page=perfil" class="<?= isset($_GET["page"]) ? "text-yellow-500" : "text-white" ?> flex items-center gap-2 font-medium hover:text-yellow-500 transition cursor-pointer">
         <i class="fas fa-user text-lg"></i>
         <span>Perfil</span>
      </a>
   <?php endif ?>
</div>