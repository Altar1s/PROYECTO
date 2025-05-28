<div class="bg-gray-800 p-4 rounded-t-lg flex items-center shadow">
   <button id="btn-back-btns" data-type="chats" class="sm:hidden items-center hover:cursor-pointer text-white px-2 py-1 mr-2">
      <i class="fas fa-angle-left text-white"></i>
   </button>
   <?php if ($_SESSION["rol"] == "profesor"): ?>
      <button id="btn-back-chat" data-type="messages" data-chat-id="<?= $chatId ?>" data-chat-name="<?= trim($chatName) ?>" class="hidden btn-show-chat items-center hover:cursor-pointer text-white px-2 py-1 mr-2">
         <i class="fas fa-angle-left text-white"></i>
      </button>
      <button id="btn-back-members" data-type="members" data-chat-id="<?= $chatId ?>" data-chat-name="<?= trim($chatName) ?>" class="hidden btn-show-members items-center hover:cursor-pointer text-white px-2 py-1 mr-2">
         <i class="fas fa-angle-left text-white"></i>
      </button>
   <?php endif ?>
   <p class="flex-1 text-lg font-semibold text-white"><?= $chatName ?></p>
   <span class="text-3xl text-gray-800">.</span>
   <?php if ($_SESSION["rol"] == "profesor"): ?>
      <button id="btn-members" data-type="members" data-chat-id="<?= $chatId ?>" class="btn-show-members bg-white text-gray-800 font-medium py-1.5 px-4 rounded-lg shadow-xs hover:bg-gray-100 hover:shadow-md hover:cursor-pointer transition-all duration-200">
         <span class="hidden sm:block">Ver miembros</span>
         <span class="inline sm:hidden">miembros</span>
      </button>
   <?php endif ?>
</div>
<div id="msgDiv" class="overflow-y-auto p-4 pb-0 flex-1 relative">
   <?php require __DIR__ . "/mensajes.php"; ?>
</div>
<?php if ($_SESSION["rol"] == "profesor"): ?>
   <form id="send-message" class="flex items-center space-x-2 bg-gray-800 p-3 rounded-b-[inherit] shadow">
      <input
         type="hidden"
         name="type"
         value="sendMessage">
      <input
         type="hidden"
         name="chatId"
         value="<?php echo $chatId ?>">
      <input id="input-msg" type="text" name="contenido" class="w-full px-4 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 rounded-lg focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition duration-150 ease-in-out" placeholder="Escribe un mensaje...">
      <input type="submit" class="px-4 py-2 bg-white text-black rounded-lg border border-transparent hover:border-gray-800 cursor-pointer transition duration-150 ease-in-out" value="Enviar">
   </form>
<?php endif ?>