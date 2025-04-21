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
               cambiarEstilos("publicaciones")
            }
         } else {
            mostrarGrupos(data)
            cambiarEstilos("grupos")
         }
      },
      error: function (data) {
         console.log("error")
      }
   })
}

function EstilosDefault() {
   $("#contenido").addClass("rounded-t-lg")
}

function reiniciarScroll(target) {
   if (target.scrollTop < 20) {
      target.firstElementChild.style.paddingTop = '1rem';
   } else {
      target.firstElementChild.style.paddingTop = '0';
   }
}

function mostrarPublicaciones(data) {
   const aux = $("<div>")
      .addClass("py-4 space-y-4")
   const publicaciones = $("<div>")
      .on("scroll", (e) => { reiniciarScroll(e.target) })
      .addClass("flex-1 overflow-y-auto px-3")
      .append(aux)
   data.forEach((x) => {
      const titulo = $("<h2>")
         .addClass("text-lg text-black font-semibold").text(x.titulo)
      const contenido = $("<p>")
         .addClass("text-gray-700").text(x.contenido)
      const publicacion = $("<div>")
         .addClass("shadow bg-orange-100 rounded-lg p-4")
         .append(titulo)
         .append(contenido)
      if (x.img) {
         const divImgs = $("<div>")
            .addClass("flex gap-2")
         x.img.split(",").filter(txt => txt.length != 0).map(txt => {
            const img = $("<img>")
               .addClass("flex-1 overflow-hidden w-auto h-auto rounded-lg mt-4").attr("src", "./media/img/" + txt)
            divImgs.append(img)
         }
         )
         publicacion.append(divImgs)
      }
      aux.append(publicacion)
   });
   $("#contenido").html("")
      .append(publicaciones)
}


function mostrarGrupos(data) {
   const divChats = $("<div>")
      .addClass("overflow-y-auto")
   const divMsgs = $("<div>")
      .attr("id", "chat")
      .addClass("flex flex-col flex-1 bg-gray-200 rounded-lg")
   data.forEach((x) => {
      const btn = $("<button>")
         .attr("data-chatId", x.id)
         .addClass("bg-orange-100 rounded-lg p-4  mb-4 text-lg text-black font-semibold hover:cursor-pointer hover:shadow-lg transition-all ease-in-out")
         .on("click", (e) => { obtenerChat(e, x.id) })
         .text(x.nombre)
      const chat = $("<div>")
         .append(btn)
      divChats.append(chat)
   })
   $("#contenido").html("")
      .append(divChats)
      .append(divMsgs)
   if (localStorage["lastChatEntered"]) {
      $(`[data-chatId="${localStorage["lastChatEntered"]}"]`).click()
   }
}

function cambiarEstilos(vistaActiva) {
   const btnPub = $("#btn_publicaciones");
   const btnGrp = $("#btn_grupos");

   [btnPub, btnGrp].forEach(btn => {
      btn.removeClass("bg-white text-slate-700 shadow")
         .addClass("bg-gray-200 text-slate-500 hover:bg-gray-300");
   });

   if (vistaActiva === "publicaciones") {
      btnPub.removeClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
         .addClass("bg-white text-slate-700 shadow");
   } else if (vistaActiva === "grupos") {
      btnGrp.removeClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
         .addClass("bg-white text-slate-700 shadow");
   }
}

function obtenerChat(e, chatId) {
   localStorage["lastChatEntered"] = chatId
   $.ajax({
      url: "./src/models/chatsModel.php",
      type: "GET",
      dataType: "json",
      data: { id: chatId },
      success: function (data) {
         mostrarChats(data, e)
      },
      error: function () {
         console.log("error")
      }
   })
}

function mostrarChats(data, e) {
   const nameChat = $("<p>")
      .text($(e.target).text())
   const nameBar = $("<div>")
      .addClass("bg-gray-100 p-4 rounded-t-lg")
      .append(nameChat)
   const mensajes = $("<div>")
      .addClass("overflow-y-auto p-4 pb-0")
   data.forEach((x) => {
      const content = $("<p>")
         .text(x.contenido)
      const mensaje = $("<div>")
         .addClass("shadow bg-orange-100 rounded-t-lg rounded-br-lg p-4 mb-4")
         .append(content)
      mensajes.append(mensaje)
   })
   $("#chat")
      .html("")
      .append(nameBar)
      .append(mensajes)
}


obtenerContenido("publicaciones")
