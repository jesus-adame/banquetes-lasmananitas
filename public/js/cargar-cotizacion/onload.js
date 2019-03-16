
addEventListener('DOMContentLoaded', () => {

   /**--------------- ESCUCHA LA TABLA CARGAR COTIZACION ------------*/
   table_carga_cot.addEventListener('click', e => {
      let btnClass = e.target.className

      if (btnClass == 'btn primary') {
         let row = document.createElement('tr')
         row.innerHTML = `<td><input type="text" name="descripcion[]"></td>
         <td><input type="number" name="precio[]"></td>
         <td><input type="number" name="cantidad[]"></td>
         <td><input type="number" name="iva[]"></td>
         <td><input type="number" name="subtotal[]"></td>
         <td>
         <button class="btn danger" type="button"><i class="fas fa-times"></i></button>
         </td>`
         tbody_cargar_cot.appendChild(row)
      }

      if (btnClass == 'btn danger') {
         e.target.parentElement.parentElement.remove()
      }
   })

   /**----------------ESCUCHA EL FORMULARIO CARGAR COTIZACION ----------*/
   form_carga_cot.addEventListener('submit', e => {
      e.preventDefault()
      const dataF = new FormData(form_carga_cot)
      dataF.append('action', 'insertar_cotizacion')

      ajaxRequest('cargar_cotizacion', dataF)
      .then(dataJson => {
         console.log(dataJson)
      })
   })
})