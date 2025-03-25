<!DOCTYPE html>
<html lang="es">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link href="./src/CSS/output.css" rel="stylesheet">
   <title>Document</title>
</head>

<body>
   <nav class="bg-gray-800 flex p-2 justify-between">
      <div class="flex items-center gap-2">
         <img class="logo" src="./src/media/img/logo.png" alt="">
         <span class="text-lg font-semibold text-white">Tegami</span>
      </div>
      <form class="flex items-center" action="./src/validacion.php" method="post">
         <div class="mr-2">
            <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3 " type="email" name="correo" placeholder="Usuario">
         </div>
         <div class="mr-2">
            <input class="bg-gray-900 text-white border border-gray-200 rounded py-1 px-3" type="password" name="clave" placeholder="Contraseña">
         </div>
         <input class="bg-yellow-500 hover:bg-yellow-600 text-gray-900 py-1 px-3 rounded font-semibold hover:cursor-pointer" type="submit" name="enviar" value="Iniciar Sesión">
      </form>
   </nav>

   <div id="main">
      <div></div>
   </div>
</body>

</html>