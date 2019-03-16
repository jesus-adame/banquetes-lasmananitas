
function printModalCotizacion(dataCot) {
   lugar.innerHTML = dataCot.lugar
   cliente.innerHTML = dataCot.contacto
   titulo.innerHTML = dataCot.title
   pax.innerHTML = dataCot.personas + ' PAX'
   tipo.innerHTML = dataCot.evento
}

function printTableCotizacion(dataCot) {
   table_rows = ''

   if (dataCot.length > 0) {
      for (let i in dataCot) {
         cot = dataCot[i];
         estado = 'No autorizada'
         if (cot.estado == 1) {
            estado = 'Autorizada'
         }

         table_rows += `<tr data-item="${cot.id}">
         <td><button class="btn default">${cot.folio}</button></td>
         <td>${cot.fecha}</td>
         <td>${cot.renta}</td>
         <td>${cot.cliente}</td>
         <td>${estado}</td>
         <td>${cot.costo_total}</td><td>
         <div class="row">
         <button class="btn atention">
         <i class="fas fa-pen-alt"></i>
         </button>
         <button class="btn danger">
         <i class="fas fa-trash-alt"></i>
         </button></div></td></tr>`
      }
   }
   tbody_cotizaciones.innerHTML = table_rows

}