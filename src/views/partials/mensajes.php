<?php foreach ($mensajes as $mensaje): ?>
   <div class="bg-white rounded-2xl p-3 mb-3 shadow border border-gray-200">
      <p class="text-slate-800 text-sm"><?= htmlspecialchars($mensaje["contenido"]) ?></p>
   </div>
<?php endforeach ?>