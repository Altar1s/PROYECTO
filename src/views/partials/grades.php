<tr class="hover:bg-gray-100 transition-colors">
   <td class="px-4 py-2 font-medium text-gray-900"><?php echo $course[0]["nombre_curso"] ?></td>
   <?php foreach ($course as $grade): ?>
      <td class="px-4 py-2 text-gray-700"><?php echo $grade["nota"] ?></td>
   <?php endforeach ?>
</tr>