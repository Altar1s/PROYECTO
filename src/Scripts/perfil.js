const content = $("#content")
const adminBtns = $(".admin-btn")
const requestBox = $("#request-display-info")
const deleteModal = $("#deleteModal")
const aboveDisplay = $("#above-display-info")

content.on("click", ".admin-btn", (e) => {
   fetchData(e)
   setbuttonStyle(e)
})

content.on("click", ".btn-delete", (e) => {
   showDeleteModal(e)
})

content.on("click", "#confirmDelete", (e) => {
   deleteEntity(e)
   deleteModal.addClass("hidden")
})

content.on("click", "#cancelDelete", () => {
   deleteModal.addClass("hidden")
})


$("#btn-admin-professors").click()

function fetchData(e) {
   const request = $(e.target).data("request");

   $.ajax({
      url: "./src/controllers/perfilController.php",
      type: "GET",
      dataType: "html",
      data: { type: request },

      success: function (result) {
         requestBox.html(result)
      },

      error: function () {
         console.log("error")
      }
   })
}

function setbuttonStyle(e) {
   adminBtns.removeClass("bg-zinc-600")
      .addClass("bg-gray-800")
   $(e.target).addClass("bg-zinc-600")
      .removeClass("bg-gray-800")
}

function sendPetition(action, id, entity) {
   $.ajax({
      url: "./src/controllers/perfilController.php",
      type: "GET",
      dataType: "html",
      data: { type: action, id: id, entity: entity },
      success: function (result) {
         $("#alert").remove()
         aboveDisplay.append(result)
         setTimeout(() => {
            $("#alert").addClass("opacity-0")
         }, 3000)
         $(`[data-request='${entity}']`).click()
      }
   });
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

   deleteModal.removeClass("hidden")
}