var consultaAnterior = null
$("#btn_publicaciones").on("click", () => { obtenerContenido("publicaciones") })
$("#btn_grupos").on("click", () => { obtenerContenido("grupos") })


function obtenerContenido(tipoConsulta) {
   if (consultaAnterior == tipoConsulta) {
      return
   }
   consultaAnterior = tipoConsulta
   $.ajax({
      url: "./src/models/homeModel.php",
      type: "GET",
      dataType: "json",
      data: { tipo: tipoConsulta },
      success: function (data) {
         if (tipoConsulta == "publicaciones") {
            mostrarPublicaciones(data)
            if ($("#btn_publicaciones").length == 0) {
               EstilosDefault()
            } else {
               EstilosPublicaciones()
            }
         } else {
            mostrarGrupos(data)
            EstilosGrupos()
         }
      },
      error: function (data) {
         console.log("error")
      }
   })
}

function EstilosDefault() {
   $("#contenido").addClass("rounded-t-lg")
   $("#contenido").parent().removeClass("bg-gray-200")
}

function mostrarPublicaciones(data) {
   let html = "";
   data.forEach((x) => {
      html += `
      <div class="publicacion shadow bg-orange-100 rounded-lg p-4 mb-4">
         <h2 class="text-lg text-black font-semibold">${x.titulo}</h2>
         <p class="text-gray-700">${x.contenido}</p>
            ${x.img ? `
            <div class='flex gap-2'>
               ${x.img.split(",").filter(txt => txt.length != 0).map(img => `
               <img class='flex-1 overflow-hidden mx-auto w-auto h-auto rounded-lg my-4' src='./media/img/${img}'>
               `).join('')}
            </div>
            ` : ''}
      </div>`;
   });
   $("#contenido").html(html);
}

function EstilosPublicaciones() {
   $("#btn_grupos").removeClass("bg-white")
   $("#btn_grupos").addClass("bg-gray-200")
   $("#btn_grupos").removeClass("text-slate-700")
   $("#btn_grupos").addClass("text-slate-500")
   $("#btn_grupos").addClass("hover:bg-gray-300")
   $("#btn_publicaciones").removeClass("hover:bg-gray-300")
   $("#btn_publicaciones").removeClass("bg-gray-200")
   $("#btn_publicaciones").addClass("bg-white")
   $("#btn_publicaciones").removeClass("text-slate-500")
   $("#btn_publicaciones").addClass("text-slate-700")
   $("#contenido").removeClass("rounded-tl-lg")
   $("#contenido").addClass("rounded-tr-lg")
}

function mostrarGrupos(data) {
   $("#contenido").html("")
   let html = "";
   data.forEach((x) => {
      html += `<div div class="bg-orange-100 rounded-lg p-4  mb-4" >
         <h2 class="text-lg text-black font-semibold">${x.nombre}</h2>
   </div> `
   });
   $("#contenido").html(html)
}

function EstilosGrupos() {
   $("#btn_publicaciones").removeClass("bg-white")
   $("#btn_publicaciones").addClass("bg-gray-200")
   $("#btn_publicaciones").removeClass("text-slate-700")
   $("#btn_publicaciones").addClass("text-slate-500")
   $("#btn_publicaciones").addClass("hover:bg-gray-300")
   $("#btn_grupos").removeClass("hover:bg-gray-300")
   $("#btn_grupos").removeClass("bg-gray-200")
   $("#btn_grupos").addClass("bg-white")
   $("#btn_grupos").removeClass("text-slate-500")
   $("#btn_grupos").addClass("text-slate-700")
   $("#contenido").removeClass("rounded-tr-lg")
   $("#contenido").addClass("rounded-tl-lg")
}

obtenerContenido("publicaciones")
