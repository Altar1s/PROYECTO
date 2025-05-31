import { actionModal, actionFormData, actionAdminBtns, actionDelete, actionSession } from "./api.js"

export function iniciarPerfil() {
   const menuToggle = $("#menu-toggle")
   const menuClose = $("#menu-close")
   const mobileMenu = $("#mobile-menu")
   const adminBtns = $(".admin-btn")
   const profileContainer = $("#profile-container")
   const modalContainer = $("#modal-container")

   //menu desplegable
   menuToggle.on("click", () => {
      mobileMenu.removeClass('translate-x-full');
      mobileMenu.addClass('translate-x-0');
   })

   menuClose.on('click', () => {
      mobileMenu.removeClass('translate-x-0');
      mobileMenu.addClass('translate-x-full');
   });

   //abrir la modal de agregar nueva entidad
   profileContainer.on("click", ".btn-show-modal", (e) => {
      checkSession()
         .done(() => {
            const data = $(e.target).data()

            actionModal(data).done((result) => {
               modalContainer.html(result)
               if (!$(result).hasClass("select2")) {
                  return
               }
               $("#busqueda").select2({
                  placeholder: "Elige una opción...",
                  allowClear: true
               });
            })
         })
   })

   //boton que cierra las modales
   profileContainer.on("click", "#cancel-action", (e) => {
      $(e.target).closest(".modal").remove()
   })

   //actuar acorde a los datos enviados del form
   profileContainer.on("submit", ".form", (e) => {
      handleFormSubmit(e, (result) => {
         setLoadingScreen()
         //modal rspuesta
         setTimeout(() => {
            modalContainer.html(result)
            setTimeout(() => {
               modalContainer.html("")
               $(".btn-requested").click()
            }, 1500)
         }, 2500);
      })
   })

   //cambiar vista en la tabla de admins
   profileContainer.on("click", ".admin-btn", (e) => {
      checkSession().done(() => {
         setbuttonStyle(e)
         const data = $(e.currentTarget).data()
         const table = $("#table-data")
         actionAdminBtns(data).done((result) => {
            table.html(result)
         })
      })
   })

   //elimina registro
   profileContainer.on("click", "#confirm-delete", (e) => {
      checkSession().done(() => {
         const data = $(e.target).data()
         setLoadingScreen()
         actionDelete(data).done((result) => {
            //modal rspuesta
            setTimeout(() => {
               modalContainer.html(result)
               setTimeout(() => {
                  modalContainer.html("")
                  $(".btn-requested").click()
               }, 1500)
            }, 2500);
         })
      })
   })

   //revisa si la sesion sigue activa
   function checkSession() {
      const deferred = $.Deferred()

      actionSession()
         .done((response) => {
            if (!response.isActive) {
               window.location.href = response.href
               deferred.reject()
            } else {
               deferred.resolve()
            }
         })

      return deferred.promise();
   }

   //funcion generica que maneja el envio de formularios
   function handleFormSubmit(e, onSuccess) {
      e.preventDefault()

      checkSession().done(() => {
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
      })
   }

   function setLoadingScreen() {
      const data = { modaltype: "load" }
      actionModal(data).done((result) => {
         modalContainer.html(result)
      })
   }

   function setbuttonStyle(e) {
      adminBtns.removeClass("btn-requested bg-zinc-600").addClass("bg-gray-800")
      $(e.currentTarget).addClass("btn-requested bg-zinc-600").removeClass("bg-gray-800")
   }
}

