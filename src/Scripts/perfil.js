export function iniciarPerfil() {
   console.log("iniciarPerfil cargado")
   const adminBtns = $(".admin-btn")
   const profileContainer = $("#profile-container")
   const aboveDisplay = $("#above-display-info")
   const modalContainer = $("#modal-container")
   const requestBox = $("#request-display-info")

   adminBtns.on("click", (e) => {
      fetchData(e)
      setbuttonStyle(e)
   })

   profileContainer.on("click", ".btn-delete", (e) => {
      showDeleteModal(e)
   })

   profileContainer.on("click", "#confirm-delete", (e) => {
      deleteEntity(e)
      $("#deleteModal").remove()
   })

   profileContainer.on("click", "#cancel-action", (e) => {
      $(e.target).closest(".modal").remove()
   })

   profileContainer.on("click", "#add-btn", (e) => {
      showAddModal(e)
   })

   $("#btn-admin-professors").click()


   function fetchData(e) {
      const request = $(e.target).data("request")

      $.ajax({
         url: "./src/controllers/perfilController.php",
         type: "GET",
         dataType: "html",
         data: { type: request },
         success: (result) => requestBox.html(result),
         error: () => console.log("error")
      })
   }

   function setbuttonStyle(e) {
      adminBtns.removeClass("bg-zinc-600").addClass("bg-gray-800")
      $(e.target).addClass("bg-zinc-600").removeClass("bg-gray-800")
   }

   function sendPetition(action, id, entity) {
      $.ajax({
         url: "./src/controllers/perfilController.php",
         type: "GET",
         dataType: "html",
         data: { type: action, id, entity },
         success: function (result) {
            $("#alert").remove()
            aboveDisplay.append(result)
            setTimeout(() => $("#alert").addClass("opacity-0"), 3000)
            $(`[data-request='${entity}']`).click()
         }
      })
   }

   function deleteEntity(e) {
      const action = $(e.target).data("action")
      const id = $(e.target).data("id")
      const entity = $(e.target).data("entity")
      sendPetition(action, id, entity)
   }

   function showDeleteModal(e) {
      $("#confirmDelete").data("action", $(e.target).data("action"))
      $("#confirmDelete").data("id", $(e.target).data("entity-id"))
      $("#confirmDelete").data("entity", $(e.target).data("entity"))

      $.ajax({
         url: "./src/views/partials/deleteModal.php",
         type: "GET",
         dataType: "html",
         success: function (result) {
            modalContainer.html(result)
         }
      })
   }

   function showAddModal(e) {
      let entity = $(e.target).data("entity")

      switch (entity) {
         case "professors":
            entity = "profesor"
            break;
         case "students":
            entity = "estudiante"
            break;
         case "groups":
            entity = "grupo"
            break;
      }

      $.ajax({
         url: "./src/views/partials/addModal.php",
         type: "POST",
         data: { entity: entity },
         dataType: "html",
         success: function (result) {
            console.log("wa")
            modalContainer.html(result)
         }
      })
   }
}
