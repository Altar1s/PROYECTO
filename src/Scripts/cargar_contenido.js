import { actionModal, actionTab, actionFormData, actionChat, actionPublication } from "./api.js"

export function iniciarHome() {
   const menuToggle = $("#menu-toggle")
   const menuClose = $("#menu-close")
   const mobileMenu = $("#mobile-menu")
   const modalContainer = $("#modal-container")
   const container = $("#contenido")
   const main = $("#main")
   let currentTab = "publications"

   //menu desplegable
   menuToggle.on("click", () => {
      mobileMenu.removeClass('translate-x-full')
      mobileMenu.addClass('translate-x-0')
   })

   menuClose.on('click', () => {
      mobileMenu.removeClass('translate-x-0')
      mobileMenu.addClass('translate-x-full')
   })

   //renderiza las vistas de los botones de la barra de navegacion
   $(".tab").on("click", (e) => {
      let tabRequested = $(e.target).data("tab")

      if (currentTab == tabRequested) {
         return
      }

      currentTab = tabRequested
      const data = { tab: tabRequested }

      actionTab(data)
         .done((result) => {
            container.html(result)
            cambiarEstilos(e)
            toggleOverflow()
         })

         .fail(() => console.log("error"))
   })

   //muestra una modal
   $("#contenido").on("click", ".btn-show-modal", (e) => {
      const data = $(e.currentTarget).data()

      actionModal(data)
         .done((result) => {
            modalContainer.html(result)
            if (!$(result).hasClass("select2")) {
               return
            }
            $("#busqueda").select2({
               placeholder: "Elige una opción...",
               allowClear: true
            })
         })
         .fail(() => console.log("error"))
   })

   //cierra la modal al hacer clic al boton con el id cancel-action
   $("#main").on("click", "#cancel-action", (e) => {
      $(e.target).closest(".modal").remove()
   })

   // añadir publicacion 
   $("#main").on("submit", "#add-publications", (e) => {
      handleFormSubmit(e, (response) => {
         container.html(response)
      })
   })

   //enviar mensaje al chat
   $("#main").on("submit", "#send-message", (e) => {
      handleFormSubmit(e, (response) => {
         const msgContainer = $("#msgDiv")
         msgContainer.html(response)
         msgContainer.scrollTop(msgContainer[0].scrollHeight)
      })
   })

   //renderiza los chats de los botones del chat (para el responsive)
   container.on("click", ".chat-button", (e) => {
      const btn = $(e.target)
      const data = { type: btn.data("type"), id: btn.data("chat-id"), nombre: btn.text() }
      const chatContainer = $("#chat")

      actionChat(data)
         .done((result) => {
            chatContainer.html(result)
            chatSelectedStyle(e)
            $("#chat-btns").removeClass("flex")
            $("#chat-btns").addClass("hidden")
            $("#chat").removeClass("hidden")
            $("#chat").addClass("flex")
            $("#msgDiv").scrollTop($("#msgDiv")[0].scrollHeight)
         })

         .fail(() => console.log("error"))
   })

   //cargar responsive menu chats
   container.on("click", "#btn-back-btns", (e) => {
      const data = $(e.currentTarget).data()

      actionChat(data).done((result) => {
         container.html(result)
      })
   })

   //cargar los miembros del chat 
   container.on("click", ".btn-show-members", (e) => {
      const btn = $(e.currentTarget)
      const data = { type: btn.data("type"), id: btn.data("chat-id") }
      const membersContainer = $("#msgDiv")

      actionChat(data).done((result) => {
         membersContainer.html(result)
         toggleChatButtons()
      })
   })

   //volver a la vista del chat principal
   container.on("click", ".btn-show-chat", (e) => {
      const btn = $(e.currentTarget)
      const data = { type: btn.data("type"), id: btn.data("chat-id"), nombre: btn.data("chat-name") }
      const chatContainer = $("#chat")

      actionChat(data).done((result) => {
         chatContainer.html(result)
         $("#msgDiv").scrollTop($("#msgDiv")[0].scrollHeight)
      })
   })

   //ver notas del estudiante del chat
   container.on("click", ".btn-student-grades", (e) => {
      const btn = $(e.target)
      const data = { type: btn.data("type"), studentId: btn.data("student-id"), chatId: btn.data("chat-id") }
      const gradesContainer = $("#msgDiv")

      actionChat(data)
         .done((result) => {
            gradesContainer.html(result)
            toggleChatButtons()
         })
   })


   //caso especifico tras añadir un estudiante al chat 
   $("#main").on("submit", "#add-student-to-chat", (e) => {
      handleFormSubmit(e, (response) => {
         const membersContainer = $("#msgDiv")
         membersContainer.html(response)
         $(e.target).closest(".modal").remove()
         setTimeout(() => {
            $("#alert").addClass("opacity-0")
            setTimeout(() => {
               $("#alert").remove()
            }, 300)
         }, 1500)
      })
   })

   //funcion generica para manejar el submit de los formularios
   function handleFormSubmit(e, onSuccess) {
      e.preventDefault()
      const form = $(e.target)[0]
      const data = new FormData(form)

      // Verificar el tamaño de las imágenes 
      const files = data.getAll("imagenes[]")

      for (const file of files) {
         if (file.size > 10 * 1024 * 1024) { // 10 MB
            actionModal({ modaltype: "error-imagen" })
               .done((result) => {
                  modalContainer.html(result)
               })
            return
         }
      }

      actionFormData(data)
         .done((result) => {
            onSuccess(result)
            form.reset()
         })
         .fail(() => console.log("error"))
   }

   //cambiar notas de un estudiante
   container.on("submit", "#edit-grades", (e) => {
      handleFormSubmit(e, (response) => {
         const responseContainer = $("#msgDiv")
         responseContainer.html(response)
         // efecto de alerta
         setTimeout(() => {
            $("#alert").addClass("opacity-0")
         }, 1500)
      })
   })

   //confirmar eliminacion de publicacion
   main.on("click", "#confirm-delete-post", (e) => {
      const btn = $(e.target)
      const data = btn.data()

      actionPublication(data)
         .done((result) => {
            container.html(result)
            btn.closest(".modal").remove()
         })

         .fail(() => console.log("error"))
   })

   //pasar a vista de edicion de publicacion
   container.on("click", ".edit-post", (e) => {
      if ($("#post-editing").length > 0) {
         $("#post-editing").closest(".post").find(".text-content").removeClass("hidden")
         $("#post-editing").remove()
      }
      const btn = $(e.currentTarget)
      const data = btn.data()
      const edit = btn.closest(".post").find(".editable-content")
      const textContent = btn.closest(".text-content")

      actionPublication(data)
         .done((result) => {
            edit.html(result)
            textContent.addClass("hidden")
         })

         .fail(() => console.log("error"))
   })

   //cancelar edicion de publicacion
   container.on("click", "#cancel-edit", (e) => {
      const btn = $(e.currentTarget)
      btn.closest(".post").find(".text-content").removeClass("hidden")
      $("#post-editing").remove()
   })

   //confirmar edicion de publicacion
   container.on("submit", "#post-editing", (e) => {
      handleFormSubmit(e, (response) => {
         container.html(response)
      })
   })



   function chatSelectedStyle(e) {
      $(".chat-button").removeClass("chat-selected bg-orange-300 shadow-lg scale-95")
      $(e.target).addClass("chat-selected bg-orange-300 shadow-lg scale-95")
   }

   function toggleChatButtons() {
      const btnBackMembers = $("#btn-back-members")
      const btnBackChat = $("#btn-back-chat")
      const btnMembers = $("#btn-members")
      const btnBackBtns = $("#btn-back-btns")
      const chatBtns = $("#chat-btns")
      const sendMessage = $("#send-message")

      if (btnBackMembers.hasClass("hidden") && btnMembers.hasClass("hidden")) {
         btnBackMembers.toggleClass("hidden") // activa la opcion de volver a los miembros
         btnBackChat.toggleClass("hidden") //desactiva la opcion de volver al chat
         return
      }

      if (btnBackChat.hasClass("hidden") && btnMembers.hasClass("hidden")) {
         btnBackMembers.toggleClass("hidden") //desactiva la opcion de volver a los miembros
         btnBackChat.toggleClass("hidden") //activa la opcion de volver al chat
         return
      }

      if (btnBackChat.hasClass("hidden") && btnMembers.hasClass("hidden") && chatBtns.hasClass("hidden")) {
         btnBackBtns.toggleClass("hidden") //activa la opcion de volver a los chats
         return
      }


      btnBackBtns.toggleClass("hidden") // desactiva la opcion de volver a los chats
      btnBackChat.toggleClass("hidden") //activa la opcion de volver al chat
      btnMembers.toggleClass("hidden") //desactiva la opcion de ver los miembros
      sendMessage.toggleClass("hidden") //desactiva el formulario de enviar mensaje
   }

   function toggleOverflow() {
      if (!$("#main").hasClass("overflow-hidden") && $("main").find("#chat").length > 0) {
         $("#main").addClass("overflow-hidden")
         $("body").addClass("h-full")
      } else {
         $("#main").removeClass("overflow-hidden")
         $("body").removeClass("h-full")
      }
   }

   function cambiarEstilos(e) {
      $(".tab")
         .removeClass("bg-[#fcfcfc] text-slate-700 shadow-xs ")
         .addClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
      $(e.target)
         .removeClass("bg-gray-200 text-slate-500 hover:bg-gray-300")
         .addClass("bg-[#fcfcfc] text-slate-700 shadow-xs ")
   }
}




