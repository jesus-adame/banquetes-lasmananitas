addEventListener('DOMContentLoaded', () => {
   form_cotizacion.querySelectorAll('input')[1].focus();

   /** CARGA LOS LUGARES DISPONIBLES EN EL FORMULARIO */
   peticionAjax('core/ajax/obtenerLugares.php', 'obtener', new FormData())
   .then(dataJson => {
      lugarHTML = `<option value="${dataJson[0].id_lugar}">- Elegir -</option>`;

      for (let i in dataJson) {
         let val = dataJson[i];
         lugarHTML += `<option value="${val.id_lugar}">${val.lugar}</option>`;
      }
      select_lugar.innerHTML = lugarHTML;
   })

   /** CARGA LOS TIPOS DE EVENTOS EN EL FORMULARIO */
   peticionAjax('core/ajax/obtenerDatos.php', 'obtener', new FormData(), 'tipo_eventos')
   .then(dataJson => {
      let eventoHTML = `<option value="${dataJson[0].id_tipo_evento}">- Elegir -</option>`;

      for (let i in dataJson) {
         let val = dataJson[i];
         eventoHTML += `<option value="${val.id_tipo_evento}">${val.nombre_tevento}</option>`;
      }
      select_evento.innerHTML = eventoHTML;
   })

   /** ESCUCHA CUANDO SE ENVÍA EL FORMULARIO DE COTIZACIÓN */
   document.addEventListener('submit', (e) => {
      e.preventDefault();
      e.stopPropagation();

      /** SE ALMACENAN LO DATOS DEL FORM */
      let userData = new FormData(e.target);

      if (userData.get('cliente') != null && userData.get('telefono') != null
      && userData.get('email') != null && userData.get('pax') != null) {

         if (d_init.value + ' ' + t_init.value < d_end.value + ' ' + t_end.value) {

            /** COMPRUEBA LA DISPONIBILIDAD EN EL BACKEND */
            peticionAjax('core/ajax/cotizacion.php', 'comprobar', userData)
            .then(dataJson => {

               if (dataJson.error) {
                  popup.alert({ content: dataJson.msg });                    
               } else {
                  popup.confirm({
                     content: dataJson.msg + '<br><br>¿Registrar evento?',
                     default_btns: {
                        ok: 'Sí', cancel: 'No'
                     }
                  },
                  (clck) => {
                     if (clck.proceed) {
                        /** INSERTA EL EVENTO EN CASO DE SER CONFIRMADO */
                        let contacto = document.querySelector('input[name="cliente"]');
                        let pax = document.querySelector('input[name="pax"]');

                        /** SE CREA UN FORMDATA CON LOS DATOS NECESARIOS PARA EL BACKEND */
                        let dataEvento = new FormData(form_cotizacion);

                        dataEvento.append('title', 'NUEVO EVENT ' + dataJson.event);
                        dataEvento.append('evento', dataJson.event);
                        dataEvento.append('contacto', contacto.value.toUpperCase());
                        dataEvento.append('start', d_init.value + ' ' + t_init.value);
                        dataEvento.append('end', d_end.value + ' ' + t_end.value);
                        dataEvento.append('personas', pax.value);
                        dataEvento.append('color', '#d7c735');
                        dataEvento.append('accion', 'agregar');
                        dataEvento.append('categoria', 'Social');

                        peticionAjax('core/ajax/eventosAjaxController.php', '', dataEvento)
                        .then(json => {
                           if (json) {
                              /** REGARGA EL CALENDARIO */
                              $('#calendar').fullCalendar('refetchEvents');
                           }
                        })
                     }
                  });
               }
            })

         } else {
            popup.alert({ content: 'La fecha final debe ser posterior a la fecha de inicio' });
         }
      } else { popup.alert({ content: 'Debe llenar todos los campos' }); }
   })
})

/** PROCESO DE COTIZACIÓN DEL MENU DEL EVENTO */

const modal_menu = new Modal(m_menu);

addEventListener('click', e => {
   if (e.target === modal_menu.fondo || e.target === cerrar) {
      modal_menu.cerrar();
      console.log(e.target)
   }
})

function cotizarMenu(event) {
   console.log(event)
   modal_menu.abrir();
   //location.href = 'https://www.google.com';
}

const reset = () => form_cotizacion.reset();