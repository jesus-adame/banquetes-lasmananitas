addEventListener('DOMContentLoaded', () => {
   
   const modal_precios = new Modal(m_precios);
   
   obtenerDatosJoinJoin('precios_renta', 'tipo_eventos', 'id_tipo_evento', 'lugares', 'id_lugar')
   .then(dataJson => {
      tbody_precios.innerHTML = '';        
      let data = '';
      
      for (i in dataJson) {
         item = dataJson[i];
         
         data += `<tr data-precio="${item.id_precio}">
         <td>${item.lugar}</td> <td>${item.nombre_tevento}</td> <td>$ ${item.precio_alta}</td> <td>$ ${item.precio_baja}</td>
         <td><button class="danger"><i class="fas fa-trash-alt"></i></button></td>
         </tr>`;
      }
      
      tbody_precios.innerHTML = data;
   })
   
   obtenerDatos('lugares')
   .then(dataJson => {
      select_lugar.innerHTML = '<option value="">- Elegir -</option>';
      let data = '';
      
      for (i in dataJson) {
         item = dataJson[i];
         
         data += `<option value="${item.id_lugar}">${item.lugar}</option>`;
      }
      select_lugar.innerHTML += data;
   })
   
   obtenerDatos('tipo_eventos')
   .then(dataJson => {
      select_t_evento.innerHTML = '<option value="">- Elegir -</option>';
      let data = '';
      
      for (i in dataJson) {
         item = dataJson[i];
         
         data += `<option value="${item.id_tipo_evento}">${item.nombre_tevento}</option>`;
      }
      select_t_evento.innerHTML += data;
   })
   
   window.addEventListener('click', (e) => {
      if (e.target === modal_precios.fondo || e.target === modal_precios.btn_close) {
         modal_precios.cerrar();
         form_precios.reset();

      } else if (e.target === add_precio) {
         modal_precios.titulo.innerHTML = 'Agregar Precio';
         modal_precios.abrir();
         
      } else if (e.target.className === 'danger') {
         popup.confirm({ content: 'Se borrará el registro' },
         (clck) => {
            if (clck.proceed) {
               id_e = e.target.parentElement.parentElement.dataset.precio;
               let formData = new FormData();
               formData.append('id_precio', id_e);
               
               peticionAjax('core/ajax/preciosSQL.php', 'borrar', formData)
               .then(dataJson => {
                  if (dataJson === 'not_data') {
                     popup.alert({ content: 'No se pudo borrar' })
                  } else if (dataJson === 'not_access') {
                     popup.alert({ content: 'No tiene permiso para editar esta sección' })
                  } else {
                     popup.alert({ content: 'Correcto' })
                     location.reload();
                  }
               })
            }
         })
      }
   })
   
   form_precios.addEventListener('submit', (e) => {
      let formData = new FormData(form_precios);
      
      peticionAjax('core/ajax/preciosSQL.php', 'insertar', formData)
      .then(dataJson => {
         if (dataJson.error) {
            popup.alert({ content: dataJson.msg})
         } else {
            location.reload();
         }
      })
   })

   // Barra de búsqueda
   searchBar('search', 'tbody_precios');
})