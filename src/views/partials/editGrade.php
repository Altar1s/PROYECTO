<form id="edit-grades" class="shadow">
   <input
      type="hidden"
      name="type"
      value="editGrades">
   <table class="min-w-full border-collapse rounded-lg shadow-xs overflow-hidden ring-1 ring-gray-300">
      <thead class="bg-gray-800 text-white">
         <tr>
            <th class="px-6 py-3 text-left text-sm font-bold">1ª Ev</th>
            <th class="px-6 py-3 text-left text-sm font-bold">2ª Ev</th>
            <th class="px-6 py-3 text-left text-sm font-bold">3ª Ev</th>
         </tr>
      </thead>
      <tbody class="bg-white divide-y divide-gray-200">
         <tr>
            <td class="px-4 py-2">
               <input type="number" name="nota1" min="0" max="10" step="0.1" value="<?php echo $grades[0]["nota"] ?? null ?>"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition duration-150 ease-in-out text-gray-800">
            </td>
            <td class="px-4 py-2">
               <input type="number" name="nota2" min="0" max="10" step="0.1" value="<?php echo $grades[1]["nota"] ?? null ?>"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition duration-150 ease-in-out text-gray-800">
            </td>
            <td class="px-4 py-2">
               <input type="number" name="nota3" min="0" max="10" step="0.1" value="<?php echo $grades[2]["nota"] ?? null ?>"
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-gray-800 focus:ring-1 focus:ring-gray-800 transition duration-150 ease-in-out text-gray-800">
            </td>
         </tr>
         <tr>
            <td colspan="3" class="px-4 py-2 text-right">
               <input value="Guardar Notas" name="tipo" type="submit"
                  class="btn-edit-grades px-4 py-2 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition duration-150 ease-in-out hover:cursor-pointer">
               </input>
            </td>
         </tr>
      </tbody>
   </table>
   <input type="hidden" name="student-id" value="<?php echo $studentId ?>">
   <input type="hidden" name="chat-id" value="<?php echo $chatId ?>">
</form>