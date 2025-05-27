<div class="flex gap-4 justify-end ">
   <button data-tab="publications" id="btn_publicaciones" class="tab py-3 px-6 bg-[#fcfcfc] text-slate-700
   hover:text-black text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out">
      Publicaciones
   </button>
   <?php if (isset($_SESSION["rol"]) && $_SESSION["rol"] != "admin") : ?>
      <button data-tab="chats" id="btn_chats" class="tab py-2.5 px-6 text-sm font-semibold rounded-t-lg hover:cursor-pointer focus:outline-none transition-all duration-150 ease-in-out bg-gray-200 text-slate-500 hover:bg-gray-300">
         Chats
      </button>
   <?php endif ?>
</div>