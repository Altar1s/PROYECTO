<div class="flex-1 flex flex-col mt-4">
   <div class="overflow-y-auto max-h-70 border border-gray-300 rounded shadow-md">
      <table class="min-w-full">
         <thead class="bg-gray-800 text-white sticky top-0">
            <tr>
               <th class="px-4 py-2 text-left">Curso</th>
               <th class="px-4 py-2 text-left">1ª Ev</th>
               <th class="px-4 py-2 text-left">2ª Ev</th>
               <th class="px-4 py-2 text-left">3ª Ev</th>
            </tr>
         </thead>
         <tbody class="bg-white divide-y divide-gray-200">
            <?php
            foreach ($grades as $course) {
               require __DIR__ . ("/grades.php");
            }
            ?>
         </tbody>
      </table>
   </div>
</div>