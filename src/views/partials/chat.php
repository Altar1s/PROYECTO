      <div class="bg-gray-300 p-4 rounded-t-lg">
         <p><?php echo $chat[0]["nombre"] ?></p>
      </div>

      <div id="msgDiv" class="overflow-y-auto p-4 pb-0 flex-1">
         <?php foreach ($mensajes as $mensaje): ?>
            <div class="shadow bg-gray-400 rounded-t-lg rounded-br-lg p-4 mb-4">
               <p><?php echo $mensaje["contenido"] ?></p>
            </div>
         <?php endforeach ?>
      </div>
      <?php if ($_SESSION["rol"] == "profesor"): ?>
         <form class="flex items-center space-x-2 bg-gray-300 p-3 rounded-b-[inherit]">
            <input id="input-msg" type="text" class="w-full px-4 py-2 bg-white text-gray-900 placeholder:text-gray-500 border border-gray-400 rounded-lg focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition duration-150 ease-in-out" placeholder="Escribe un mensaje...">
            <input id="btn-send-msg" type="submit" class="px-4 py-2 bg-white text-black rounded-lg border border-transparent hover:border-gray-800 cursor-pointer transition duration-150 ease-in-out" value="Enviar">
         </form>
      <?php endif ?>