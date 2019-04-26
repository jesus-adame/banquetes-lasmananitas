
/** SOLICITA UN SERVICIO DEL SERVIDOR */

async function ajaxRequest(service, formData) {
   formData.append('module', service)

   return fetch('core/Core.php', {
      method: 'POST',
      body: formData
   })
   .then(response => response.json())
}