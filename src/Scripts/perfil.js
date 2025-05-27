import { actionModal, actionFormData, actionAdminBtns, actionDelete } from "./api.js"

export function iniciarPerfil() {
   const adminBtns = $(".admin-btn")
   const profileContainer = $("#profile-container")
   const aboveDisplay = $("#above-display-info")
   const modalContainer = $("#modal-container")
   const requestBox = $("#request-display-info")
   let lastPressedButton = null

   //abrir la modal de agregar nueva entidad
   profileContainer.on("click", ".btn-show-modal", (e) => {
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

   //boton que cierra las modales
   profileContainer.on("click", "#cancel-action", (e) => {
      $(e.target).closest(".modal").remove()
   })

   //enviar datos para agregar entidad
   profileContainer.on("submit", ".form", (e) => {
      setLoadingScreen()
      handleFormSubmit(e, (result) => {
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
      setbuttonStyle(e)
      const data = $(e.target).data()
      const table = $("#table-data")

      actionAdminBtns(data).done((result) => {
         table.html(result)
      })

   })

   //elimina registro
   profileContainer.on("click", "#confirm-delete", (e) => {
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



   //funcion generica que maneja el envio de formularios
   function handleFormSubmit(e, onSuccess) {
      e.preventDefault(e)
      const form = $(e.target)
      const data = new FormData(form[0])

      actionFormData(data)
         .done((result) => {
            onSuccess(result)
            form[0].reset()
         })

         .fail(() => console.log("error"))
   }

   function setLoadingScreen() {
      const data = { modaltype: "load" }
      actionModal(data).done((result) => {
         modalContainer.html(result)
      })
   }

   function setbuttonStyle(e) {
      adminBtns.removeClass("btn-requested bg-zinc-600").addClass("bg-gray-800")
      $(e.target).addClass("btn-requested bg-zinc-600").removeClass("bg-gray-800")
   }
}

