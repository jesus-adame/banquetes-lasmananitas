
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
         btn_imprimir.dataset.folio = cot.folio

         if (cot.estado == 1)
            estado = 'Autorizada'

         if (cot.total === null)
            cot.total = cot.renta

         table_rows += `<tr data-item="${cot.folio}">
         <td><button class="btn default">${cot.folio}</button></td>
         <td>${cot.fecha}</td>
         <td>${cot.renta}</td>
         <td>${cot.cliente}</td>
         <td>${estado}</td>
         <td>${cot.total}</td><td>
         <div class="row">
         <button class="btn atention">
         <i class="fas fa-ellipsis-v"></i>
         </button></div></td></tr>`
      }
   }
   tbody_cotizaciones.innerHTML = table_rows

}