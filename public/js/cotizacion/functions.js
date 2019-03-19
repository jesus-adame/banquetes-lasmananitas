
function loadSelectLugares() {
   return peticionAjax('core/ajax/obtenerLugares.php', 'obtener', new FormData())
   .then(dataJson => {
      lugarHTML = `<option value="${dataJson[0].id_lugar}">- Elegir -</option>`;

      for (let i in dataJson) {
         let val = dataJson[i];
         lugarHTML += `<option value="${val.id_lugar}">${val.lugar}</option>`;
      }
      select_lugar.innerHTML = lugarHTML;
   })
}

function loadSelectTiposEvento() {
   let dataEvent = new FormData;
   dataEvent.append('tabla', 'tipo_eventos');

   peticionAjax('core/ajax/obtenerDatos.php', 'obtener', dataEvent)
   .then(dataJson => {
      let eventoHTML = `<option value="${dataJson[0].id_tipo_evento}">- Elegir -</option>`;

      for (let i in dataJson) {
         let val = dataJson[i];
         eventoHTML += `<option value="${val.id_tipo_evento}">${val.nombre_tevento}</option>`;
      }
      select_evento.innerHTML = eventoHTML;
   })
}

function insertEvent(formData, dataEvent) {
   let pax = document.querySelector('input[name="pax"]');
   
   formData.append('title', 'NUEVO EVENT ' + dataEvent.event);
   formData.append('evento', dataEvent.event);
   formData.append('nombre', c_nombre.value.toUpperCase());
   formData.append('apellido', c_apellido.value.toUpperCase());
   formData.append('start', d_init.value + ' ' + t_init.value);
   formData.append('end', d_end.value + ' ' + t_end.value);
   formData.append('personas', pax.value);
   formData.append('color', '#d7c735');
   formData.append('categoria', 'Social');
   formData.append('action', 'insert_event');

   return ajaxRequest('cotizacion', formData)
}

function getTotales(formData) {
   ajaxRequest('cotizacion', formData)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({ content: dataJson.msg })
      } else {
         let totales = dataJson.data
         t_total.innerHTML = '$ ' + totales.total
      }
   })
}