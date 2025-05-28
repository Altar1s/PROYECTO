<div class="p-4 bg-white rounded-lg shadow mb-5 mt-2">
   <h1 class="mb-4 text-3xl font-medium">Crear publicación</h1>
   <form id="add-publications" enctype="multipart/form-data" class="flex flex-col">
      <input
         type="hidden"
         name="type"
         value="addPublication">
      <input
         class="p-1 mb-3 border border-gray-300 rounded"
         name="titulo"
         type="text"
         placeholder="Título" required>
      <textarea
         class="p-1 h-46 mb-3 resize-none border border-gray-300 rounded"
         name="contenido"
         placeholder="Contenido" required></textarea>
      <span class="block w-full px-2 py-1 text-xs text-gray-500 font-medium bg-gray-100 rounded mb-1">
         Solo se admiten imágenes de hasta 10 MB
      </span>
      <input
         name="imagenes[]"
         type="file"
         multiple
         accept=".jpg, .jpeg, .png"
         class="block text-sm text-gray-600 border border-gray-300 rounded p-1 mb-3 file:mr-3 file:py-1 file:px-2 file:rounded file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:cursor-pointer hover:file:bg-gray-200 focus:border-gray-600">
      <input
         type="submit"
         name="enviar"
         value="Publicar"
         class="inline-block py-2 px-4 bg-gray-800 text-white font-semibold border border-gray-700 rounded-md hover:cursor-pointer hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-gray-500 transition duration-150 ease-in-out">
   </form>
</div>