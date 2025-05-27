<form id="post-editing">
   <div class="flex justify-between items-start mb-4">
      <input
         type="text"
         name="titulo"
         value="<?= htmlspecialchars($title) ?>"
         class="post-title w-full text-lg font-semibold text-gray-800 border-none outline-none focus:ring-2 focus:ring-slate-400 rounded p-1 transition-colors duration-300"
         placeholder="Título de la publicación" />
      <input
         type="hidden"
         name="type"
         value="editPost" />
      <input
         type="hidden"
         name="id"
         value="<?= $postId ?>" />
      <div class="post-actions flex gap-2 ml-2">
         <button
            id="cancel-edit"
            type="button"
            class="cancel-edit flex items-center gap-1 text-sm px-3 py-1.5 border border-gray-300 rounded-md text-gray-600 hover:bg-gray-100 hover:text-gray-800 transition duration-200 hover:cursor-pointer shadow-sm">
            <i class="fas fa-times"></i>
            Cancelar
         </button>
         <button
            type="submit"
            class="save-edit flex items-center gap-1 text-sm px-3 py-1.5 rounded-md bg-slate-800 text-white hover:bg-slate-900 transition duration-200 hover:cursor-pointer shadow-sm">
            <i class="fas fa-save"></i>
            Guardar
         </button>
      </div>
   </div>
   <textarea
      name="contenido"
      rows="4"
      class="post-content w-full text-sm text-gray-700 border border-slate-200 rounded p-2 focus:outline-none focus:ring-2 focus:ring-slate-400 transition-colors duration-300 resize-none"
      placeholder="Contenido de la publicación"><?= htmlspecialchars($content) ?></textarea>
</form>