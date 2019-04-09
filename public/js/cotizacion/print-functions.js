
function printModalCotizacion(dataCot) {
   /** TODO: REPARAR LA MAQUETACIÓN DE LA TABLA */
   let userData = new FormData;
   userData.append('action', 'obtener_uno')
   userData.append('usuario_id', dataCot.id_usuario)
   
   ajaxRequest('usuarios', userData)
   .then(dataJson => {
      if (dataJson.error) {
         return usuario.innerHTML = 'No se encontró el vendedor';
      }
      let user = dataJson.usuario
      usuario.innerHTML = user.username
   })
   pax.innerHTML     = dataCot.personas + ' PAX'
   tipo.innerHTML    = dataCot.evento
   evento_id.value   = dataCot.id_evento
   lugar.innerHTML   = dataCot.lugar
   titulo.innerHTML  = dataCot.title
   cliente.innerHTML = dataCot.contacto
}

function printTableCotizacion(dataCot) {
   table_rows = ''

   if (dataCot.length > 0) {
      for (let i in dataCot) {
         cot                        = dataCot[i];
         estado                     = 'No autorizada';
         color                      = 'background: #ff2217';
         btn_imprimir.dataset.folio = cot.folio;
         f_formato              = new Date(cot.fecha);
         fecha = (f_formato.getDate() + 1) + '/' + MESES[f_formato.getMonth()] + '/' + f_formato.getFullYear();
         
         if (cot.estado == 1) {
            estado                  = 'Autorizada';
            color                   = 'background: green';
            send_mail.style.display = 'block';
         } else {
            send_mail.style.display = 'none';
         }
         
         if (cot.total === null)
         cot.total = cot.renta;

         renta = parseFloat(cot.renta).toLocaleString('es-MX', formato_moneda);
         total = parseFloat(cot.total).toLocaleString('es-MX', formato_moneda);
         
         table_rows += `<tr data-item="${cot.folio}">
         <td>${fecha}</td>
         <td>$ ${renta}</td>
         <td>${cot.usuario}</td>
         <td>$ ${total}</td>
         <td style="${color};color:#fff">${estado}</td><td>
         <button class="btn atention">
         <i class="far fa-eye"></i>
         </button></td></tr>`
      }
   } else {
      table_rows = `<tr><td colspan="7"><button class="btn primary">Crear Cotización</botton></td></tr>`
   }
   tbody_cotizaciones.innerHTML = table_rows
}