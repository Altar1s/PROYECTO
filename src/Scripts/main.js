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
