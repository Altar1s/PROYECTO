<div class="flex-1 flex gap-4">
   <div class="overflow-y-auto">
      <?php foreach ($chats_data as $chat): ?>
         <div>
            <button data-chat-id="<?php echo $chat["id"] ?>" class="chat-button w-full bg-orange-100 rounded-lg p-4 mb-4 text-lg text-black font-semibold hover:cursor-pointer hover:shadow-lg transition-all ease-in-out active:scale-95">
               <?php echo $chat["nombre"] ?>
            </button>
         </div>
      <?php endforeach ?>
   </div>
   <div id="chat" class="flex flex-col flex-1 bg-gray-200 rounded-lg">

   </div>
</div>