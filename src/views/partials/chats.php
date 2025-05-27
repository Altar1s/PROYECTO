<div class="flex flex-row gap-2 sm:gap-4 flex-1">
   <div id="chat-btns" class="w-full flex sm:flex flex-col gap-3 flex-shrink-0 sm:w-42 lg:w-64 overflow-y-auto">
      <?php foreach ($chats_data as $chat): ?>
         <button
            data-type="messages"
            data-chat-id="<?= $chat["id"] ?>"
            class="chat-button w-full bg-orange-100 text-lg rounded-lg p-4 sm:p-3 sm:text-lg text-black font-semibold hover:shadow-lg hover:bg-orange-200 active:scale-95 transition-all duration-150 ease-in-out">
            <?= $chat["nombre"] ?>
         </button>
      <?php endforeach ?>
   </div>
   <div id="chat" class="hidden sm:flex  flex-col flex-1 bg-gray-200 rounded-lg">

   </div>

</div>