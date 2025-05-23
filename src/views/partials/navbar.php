<nav class="bg-gray-800 top-0 left-0 sticky">
   <div class="container mx-auto py-2 px-4 lg:max-w-7xl flex  justify-between">
      <div>
         <a class=" flex items-center gap-2" href="<?php echo URL ?>">
            <img class="logo" src="<?php echo URL ?>assets/img/logo.png" alt="">
            <span class="text-lg font-semibold text-white">Tegami</span>
         </a>
      </div>
      <?php if (!isset($_SESSION["logged"])): ?>
         <form class="flex items-center mr-2" action="<?php echo URL ?>src/models/loginModel.php" method="post">
            <div class="mr-2">
               <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3 " type="email" name="correo" placeholder="Usuario">
            </div>
            <div class="mr-2">
               <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3" type="password" name="clave" placeholder="Contraseña">
            </div>
            <input class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer transition-all ease-in-out" type="submit" name="enviar" value="Iniciar Sesión">
         </form>
      <?php else: ?>
         <div class="flex items-center mr-2 text-white hover:text-yellow-500 transition-all ease-in-out">
            <a id="profile-btn" href="<?php echo URL ?>index.php?page=perfil">
               <i class="fa-solid fa-user text-2xl"></i>
            </a>
         </div>
      <?php endif ?>
   </div>
</nav>