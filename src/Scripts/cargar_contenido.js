var consultaAnterior = null
$("#btn_publicaciones").on("click", () => { obtenerContenido("publicaciones") })
$("#btn_grupos").on("click", () => { obtenerContenido("grupos") })


function obtenerContenido(tipoConsulta) {
   if (consultaAnterior == tipoConsulta) {
      return
   }
   consultaAnterior = tipoConsulta
   $.ajax({
      url: "./src/controllers/contenido_landing.php",
      type: "GET",
      dataType: "json",
      data: { tipo: tipoConsulta },
      success: function (data) {
         if (tipoConsulta == "publicaciones") {
            mostrarPublicaciones(data)
         } else {
            mostrarGrupos(data)
         }
      },
      error: function (data) {
         console.log("error")
      }
   })
}

function mostrarPublicaciones(data) {
   $("#contenido").html("")
   data.forEach((x) => {
      let aux = $("#contenido").html()
      aux += `<div class=" publicacion bg-white rounded-lg p-4  mb-4">
      <h2 class="text-lg text-black font-semibold">${x.titulo}</h2>
      <p class="text-gray-700">${x.contenido}</p>
   </div>`
      $("#contenido").html(aux)
   });
}

function mostrarGrupos(data) {
   $("#contenido").html("")
   data.forEach((x) => {
      let aux = $("#contenido").html()
      aux += `<div class="bg-white rounded-lg p-4  mb-4">
      <h2 class="text-lg text-black font-semibold">${x.nombre}</h2>
   </div>`
      $("#contenido").html(aux)
   });
}

obtenerContenido("publicaciones");
