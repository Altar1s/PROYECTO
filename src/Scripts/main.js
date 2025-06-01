import { iniciarPerfil } from './perfil.js'
import { iniciarHome } from './cargar_contenido.js'

$(document).ready(() => {
   if ($("#profile-container").length > 0) {
      iniciarPerfil()
   }
   if ($("#contenido").length > 0) {
      iniciarHome()
   }
})

//evitar mostrar la cache del navegador del login al volver hacia atrás
$(window).on('pageshow', function (event) {
   if (event.originalEvent.persisted || (window.performance && window.performance.navigation.type === 2)) {
      // Verificamos si la página es el login y el usuario tiene rol (está logueado)
      const currentPage = new URLSearchParams(window.location.search).get('page') || 'Login';

      if (currentPage.toLowerCase() === 'login') {
         // Si está logueado y es la página de login, recarga
         window.location.href = './index.php?page=home';
      }
   }
});

