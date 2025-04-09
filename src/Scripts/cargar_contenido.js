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
   $("#contenido").html("");
   data.forEach((x) => {
      const publicacion = $("<div>")
      publicacion.addClass("shadow bg-orange-100 rounded-lg p-4 mb-4")
      const titulo = $("<h2>")
      titulo.addClass("text-lg text-black font-semibold")
      titulo.text(x.titulo)
      const contenido = $("<p>")
      contenido.addClass("text-gray-700")
      contenido.text(x.contenido)
      publicacion.append(titulo)
      publicacion.append(contenido)
      if (x.img) {
         const divImgs = $("<div>")
         divImgs.addClass("flex gap-2")
         x.img.split(",").filter(txt => txt.length != 0).map(txt => {
            const img = $("<img>")
            img.addClass("flex-1 overflow-hidden mx-auto w-auto h-auto rounded-lg my-4")
            img.attr("src", "./media/img/" + txt)
            divImgs.append(img)
         }
         )
         publicacion.append(divImgs)
      }
      $("#contenido").append(publicacion);
   });
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
   const flex = $("<div>")
   flex.addClass("flex gap-2 flex-auto")
   const divChats = $("<div>")
   divChats.addClass("overflow-y-auto")
   const divMsgs = $("<div>")
   divMsgs.attr("id", "chat")
   divMsgs.addClass("flex-1 p-4 bg-gray-200 rounded-lg overflow-y-auto")
   flex.append(divChats)
   flex.append(divMsgs)
   data.forEach((x) => {
      const chat = $("<div>")
      const btn = $("<button>")
      btn.addClass("bg-orange-100 rounded-lg p-4  mb-4 text-lg text-black font-semibold hover:cursor-pointer hover:shadow-lg transition-all ease-in-out")
      btn.on("click", () => { obtenerChat(x.id) })
      btn.text(x.nombre)
      divChats.append(chat.append(btn))
   });
   $("#contenido").append(flex)
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


function obtenerChat(chatId) {
   $.ajax({
      url: "./src/models/chatsModel.php",
      type: "GET",
      dataType: "json",
      data: { id: chatId },
      success: function (data) {
         mostrarChats(data)
      },
      error: function () {
         console.log("error")
      }
   })
}

function mostrarChats(data) {
   $("#chat").html("")
   data.forEach((x) => {
      const mensaje = $("<div>")
      mensaje.text(x.contenido)
      $("#chat").append(mensaje)
   })
}


obtenerContenido("publicaciones")
