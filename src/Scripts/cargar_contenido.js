export function iniciarHome() {
   console.log("que fue")
   let consultaAnterior = null
   let lastChatEntered = null
   let chatCache = null

   $(".hometab").on("click", (e) => getContent(e))

   if ($(".hometab").length === 0) {
      fetchHtml("Publicaciones")
   } else {
      $("#btn_publicaciones").click()
   }

   $("#main").on("click", "#btn_chats", () => $("#main").addClass("overflow-hidden"))
   $("#main").on("click", "#btn_publicaciones", () => $("#main").removeClass("overflow-hidden"))

   $("#contenido").on("click", ".chat-button", (e) => {
      fetchChat(e)
      chatSelectedStyle(e)
   })

   $("#contenido").on("click", "#btn-send-msg", (e) => {
      e.preventDefault()
      enviarMensaje($("#input-msg").val(), lastChatEntered)
      $("#input-val").val("")
   })

   $("#contenido").on("click", ".btn-show-members", () => getChatMembers("chatMembers"))
   $("#contenido").on("click", ".btn-show-chat", () => {
      $(`[data-chat-id='${lastChatEntered}']`).click()
      toggleChatButtons()
   })

   $("#contenido").on("click", ".btn-student-grades", (e) => getStudentGrades(e))
   $("#contenido").on("click", ".btn-edit-grades", (e) => {
      e.preventDefault()
      updateStudentGrades(e)
   })

   function getContent(e) {
      const tipoConsulta = $(e.target).text().trim()
      if (consultaAnterior === tipoConsulta) return
      consultaAnterior = tipoConsulta
      fetchHtml(tipoConsulta)
      cambiarEstilos(e)
   }

   function fetchHtml(tipoConsulta) {
      $.ajax({
         url: "./src/controllers/homeController.php",
         type: "GET",
         dataType: "html",
         data: { tipo: tipoConsulta },
         success: function (result) {
            $("#contenido").html(result)
            if (lastChatEntered && tipoConsulta === "Chats") {
               $("#contenido").html(chatCache)
            }
         },
         error: () => console.log("error")
      })

      if ($(".hometab").length === 0) {
         $("#contenido").addClass("rounded-t-lg")
      }
   }

   function fetchChat(e) {
      $.ajax({
         url: "./src/controllers/homeController.php",
         type: "GET",
         dataType: "html",
         data: { tipo: "chat", chat_id: $(e.target).data("chat-id") },
         success: function (result) {
            $("#chat").html(result)
            lastChatEntered = $(e.target).data("chat-id")
            $("#msgDiv").scrollTop($("#msgDiv")[0].scrollHeight)
            chatCache = $("#contenido").html()
         },
         error: () => console.log("error")
      })
   }

   function chatSelectedStyle(e) {
      $(".chat-button").removeClass("chat-selected bg-orange-300 shadow-lg scale-95")
      $(e.target).addClass("chat-selected bg-orange-300 shadow-lg scale-95")
   }

   function cambiarEstilos(e) {
      $(".hometab")
         .removeClass("bg-white text-slate-700 shadow-xs ")
         .addClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
      $(e.target)
         .removeClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
         .addClass("bg-white text-slate-700 shadow-xs ")
   }

   function enviarMensaje(mensaje, id) {
      if (!mensaje.length > 0) return

      $.ajax({
         url: "./src/models/sendMessageModel.php",
         type: "POST",
         dataType: "json",
         data: { msg: mensaje, chat_id: id },
         success: () => $(".chat-selected").click(),
         error: () => console.log("error")
      })
   }

   function getChatMembers(type) {
      $.ajax({
         url: "./src/controllers/homeController.php",
         type: "GET",
         dataType: "html",
         data: { tipo: type, chat_id: lastChatEntered },
         success: function (result) {
            $("#msgDiv").html(result)
            chatCache = $("#contenido").html()
         },
         error: () => console.log("error")
      })
      toggleChatButtons()
      toggleInput()
   }

   function toggleChatButtons() {
      $(".btn-show-members, .btn-show-chat").toggleClass("hidden")
   }

   function toggleInput() {
      if ($(".btn-show-members").hasClass("hidden")) {
         $(".form-chat-msg").addClass("hidden")
      } else {
         $(".form-chat-msg").removeClass("hidden")
      }
   }

   function getStudentGrades(e) {
      $.ajax({
         url: "./src/controllers/homeController.php",
         type: "GET",
         dataType: "html",
         data: {
            tipo: "notas",
            chat_id: lastChatEntered,
            student_id: $(e.target).data("student-id")
         },
         success: function (result) {
            $("#msgDiv").html(result)
            toggleChatButtons()
         },
         error: () => console.log("error")
      })
   }

   function updateStudentGrades(e) {
      $.ajax({
         url: "./src/controllers/homeController.php",
         type: "GET",
         dataType: "html",
         data: {
            tipo: "actualizar_notas",
            chat_id: lastChatEntered,
            student_id: $("[name='student_id']").val(),
            nota1: $("[name='nota1']").val(),
            nota2: $("[name='nota2']").val(),
            nota3: $("[name='nota3']").val()
         },
         success: function (result) {
            $("#msgDiv").html(result)
            setTimeout(() => $("#alert").addClass("opacity-0"), 1500)
         },
         error: () => console.log("error")
      })
   }
}
