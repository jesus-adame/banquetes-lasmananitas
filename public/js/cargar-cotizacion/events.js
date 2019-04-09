
addEventListener('DOMContentLoaded', () => {

   /**--------------- ESCUCHA LA TABLA CARGAR COTIZACION ------------*/
   table_carga_cot.addEventListener('click', e => {
      let btnClass = e.target.className

      if (btnClass == 'btn primary') {
         let row = document.createElement('tr')
         row.innerHTML = `<td><input type="text" name="descripcion[]" placeholder="Descripcion" required></td>
         <td><input class="precio" type="number" name="precio[]" placeholder="0.00" step="0.01"></td>
         <td><input class="cantidad" type="number" name="cantidad[]" placeholder="0"></td>
         <td><input class="subtotal" type="text" name="subtotal[]" disabled value="0.00"></td>
         <td>
         <button class="btn danger" type="button"><i class="fas fa-times"></i></button>
         </td>`
         tbody_cargar_cot.appendChild(row)
      }

      if (btnClass == 'btn danger') {
         const d = e.target.parentElement.parentElement.parentElement
         e.target.parentElement.parentElement.remove()
         
         setTimeout(() => {
            let subtotales = form_carga_cot.querySelectorAll('.subtotal')
            
            getSubtotal(d)
            total.value = getTotal(subtotales)
         }, 10)
      }
   })

   /**----------------ESCUCHA EL FORMULARIO CARGAR COTIZACION ----------*/

   form_carga_cot.addEventListener('submit', e => {
      e.preventDefault()
      const dataF = new FormData(form_carga_cot)
      const folio = location.search.split('&')[1].split('=')

      dataF.append('action', 'insertar_cotizacion')
      dataF.append('folio', folio[1])

      ajaxRequest('cargar_cotizacion', dataF)
         .then(dataJson => {
            if (dataJson.error) {
               popup.alert({content: dataJson.msg})
               
            } else {
               location.reload()
            }
         })
   })

   /**--------------- CARRITO DE COMPRA ----------------------*/

   tbody_cargar_cot.addEventListener('keyup', e => {
      const d = e.target.parentElement.parentElement
      let subtotales = form_carga_cot.querySelectorAll('.subtotal')

      getSubtotal(d)
      total.value = getTotal(subtotales).toLocaleString('es-MX', formato_moneda)
   })
})

/**---------------- TABLA DETALLE COTIZACION ------------------*/

tbody_detalle_cot.addEventListener('click', e => {
   let btnClass = e.target.className
   detalle_id = e.target.parentElement.parentElement.dataset.item

   if (btnClass === 'btn danger') {
      popup.confirm({
         content: '<h3>Eliminar detalle</h3><br><p>¿Está seguro?</p>',
         default_btns: {
            ok: 'SÍ', cancel: 'NO'
         }
      },
      (ck) => {
         if (ck.proceed) {
            let dataDetalle = new FormData;
            dataDetalle.append('action', 'borrar_detalle')
            dataDetalle.append('detalle_id', detalle_id)
      
            ajaxRequest('cargar_cotizacion', dataDetalle)
            .then(dataJson => {
               if (dataJson.error) {
                  popup.alert({content: dataJson.msg})

               } else {
                  location.reload()
               }
            })
         }
      })
   }
})