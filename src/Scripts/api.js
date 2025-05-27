//funcion generica que maneja las peticiones ajax
function apiRequest(url, method, dataType, data = null) {
   const isFormData = (data instanceof FormData);

   return $.ajax({
      url: url,
      type: method,
      dataType: dataType,
      data: data,
      //por si la data que se envia es de tipo FormData y con archivos
      processData: !isFormData,
      contentType: isFormData ? false : "application/x-www-form-urlencoded; charset=UTF-8"
   });
}

//hace una peticion ajax para cargar la modal
export function actionModal(data) {
   const url = "./src/controllers/modalController.php"
   const method = "GET"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

//hace una peticion ajax para enviar datos para insertar
export function actionFormData(data) {
   const url = "./src/controllers/formController.php"
   const method = "POST"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

export function actionTab(data) {
   const url = "./src/controllers/tabController.php"
   const method = "GET"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

export function actionChat(data) {
   const url = "./src/controllers/chatController.php"
   const method = "GET"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

export function actionPublication(data) {
   const url = "./src/controllers/postController.php"
   const method = "POST"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

export function actionAdminBtns(data) {
   const url = "./src/controllers/adminBtnsController.php"
   const method = "GET"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}

export function actionDelete(data) {
   const url = "./src/controllers/deleteEntityController.php"
   const method = "POST"
   const dataType = "html"

   return apiRequest(url, method, dataType, data)
}