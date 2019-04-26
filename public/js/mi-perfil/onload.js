
/** -------------------------------CONSTANTES DE CONFIGUARCIÓN----------------------------- */

const service = 'mi_perfil'; // SERVICIO PHP CON EL QUE SE TRABAJA EN ESTE ARCHIVO

/**------------------------ TABLA DETALLE DEL USUARIO ------------------*/


function loadTable() {
   const data = new FormData;
   data.append('action', 'obtener_datos');
   data.append('user', user.innerHTML)

   /** PIDE LOS DATOS AL SERVIDOR */
   ajaxRequest(service, data)
   .then(dataJson => {

      if (dataJson.error) {
         popup.alert({ content: '<b>Ocurrio un error</b><br><br>' + dataJson.msg })
         console.log(dataJson)

      } else {
         /** CARGA LOS DATOS EN LA TABLA DETALLE */
         loadUserTable(dataJson.data)
      }
   })
}

loadTable();

/**------------------- FORMULARIO DE CAMBIO DE CONTRASEÑA ---------------*/

form_pass.addEventListener('submit', (e) => {
   e.preventDefault();

   let d = new FormData(form_pass); // EMPAQUETA LOS DATOS DEL FORMLUARIO CAMBIO DE CONTRASEÑA
   d.append('action', 'cambiar_pass');

   /** PIDE EL CAMBIO DE CONTRASEÑA AL SERVIDOR */
   ajaxReq(d, 'core/ajax/registrosAjaxController.php')
   .then(dataJson => {
      if (dataJson.error) {
         throw dataJson;
      }

      popup.alert({ content: 'Su contraseña se ha actualizado' });
      form_pass.reset();
   })
   .catch(dataJson => {
      popup.alert({ content: dataJson.msg })
   })
})

const ajaxReq = (formData, url) => {
   return res = fetch(url, {
      method: 'POST',
      body: formData
   }).then(response => response.json());
}

/**------------------------ MODAL DETALLE DE USUARIO ------------------*/

const modal_detalle = new Modal(m_detalle);

/** ESCUCHA EL CLIC DEL BOTÓN EDITAR */
btn_detalle.addEventListener('click', e => {
   
   const data = new FormData;
   data.append('action', 'obtener_datos');
   data.append('user', user.innerHTML)

   /** BUSCA LOS DATOS EN EL SERVIDOR */
   ajaxRequest(service, data)
   .then(dataJson => {
   
      if (dataJson.error) {
         popup.alert({ content: '<b>Ocurrio un error</b><br><br>' + dataJson.msg })
         console.log(dataJson)

      } else {
         /** CARGA LOS DATOS EN EL FORMULARIO */
         loadUserForm(dataJson.data)
      }
   /** ABRE EL MODAL */
   }).then(() => modal_detalle.abrir())
})

addEventListener('click', e => {
   if (e.target === modal_detalle.fondo || e.target === modal_detalle.btn_close) {
      modal_detalle.cerrar();
   }
})

/**------------------------- FORMULARIO DETALLE USUARIO -------------------*/

form_detalle_user.addEventListener('submit', e => {
   e.preventDefault();

   let dataFormDetalle = new FormData(form_detalle_user); // EMPAQUETA LOS DATOS DEL FORMULARIO DETALLE USUARIO
   dataFormDetalle.append('action', 'actualizar_datos');

   /** PIDE LA ACTUALIZACIÓN DE LOS DATOS AL SERVIDOR */
   ajaxRequest(service, dataFormDetalle)
   .then(dataJson => {

      if(dataJson.error) {
         popup.alert({ content: dataJson.msg });
      } else {
         modal_detalle.cerrar()
         form_detalle_user.reset();
         loadTable();
      }
   })

})