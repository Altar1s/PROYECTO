<?php

/**
 * Carga las vistas correspondientes según el rol del usuario.
 *
 * - Admin: muestra la opción para agregar publicaciones.
 * - Estudiante o profesor: muestra las pestañas de contenido general y chats.
 *
 * @return void
 */
function showHomePage()
{
   if (isset($_SESSION["logged"])) {
      if ($_SESSION["rol"] == "admin") {
         include __DIR__ . "/../views/partials/addPublication.php";
      } else {
         include __DIR__ . "/../views/partials/homeTabs.php";
      }
   }
   require __DIR__ . "/../views/home.php";
}
