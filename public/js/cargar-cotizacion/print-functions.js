
function pintarDetalle(array) {
   let content = ''

   for (let i in array) {
      let item = array[i]
      content += `<tr data-item="${item.id}">
      <td>${item.descripcion}</td>
      <td>$ ${item.precio_unitario}</td>
      <td>${item.cantidad}</td>
      <td>$ ${item.subtotal}</td>
      <td><button class="btn danger"><i class="fas fa-trash-alt"></i></button></td></tr>`
   }
   return content
}

function pintarCotizacion(json) {
   data_evento.innerHTML = `<h3 style="margin-bottom: 5px">${json.evento}</h3>
   <p>Fecha: ${json.fecha}</p>
   <p>Renta: $ ${json.renta}</p>
   <p>Personas: ${json.pax}</p>`
}