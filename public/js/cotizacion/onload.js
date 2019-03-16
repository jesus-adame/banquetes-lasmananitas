addEventListener('DOMContentLoaded', () => {
   form_cotizacion.querySelectorAll('input')[1].focus();

   /** CARGA LOS LUGARES DISPONIBLES EN EL FORMULARIO */
   loadSelectLugares()

   /** CARGA LOS TIPOS DE EVENTOS EN EL FORMULARIO */
   loadSelectTiposEvento()

   /** ESCUCHA CUANDO SE ENVÍA EL FORMULARIO DE COTIZACIÓN */
   document.addEventListener('submit', (e) => {
      e.preventDefault();
      e.stopPropagation();

      /** SE ALMACENAN LO DATOS DEL FORM */
      let userData = new FormData(e.target);

      if (userData.get('nombre') != null && userData.get('telefono') != null
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
                        renta.value = dataJson.data
                        /** INSERTA EL EVENTO EN CASO DE SER CONFIRMADO */
                        let dataEvento = new FormData(form_cotizacion);
                        
                        /** CARGA EL EVENTO EN LA BASE DE DATOS */
                        insertEvent(dataEvento, dataJson)
                        .then(() => {
                           /** REGARGA EL CALENDARIO */
                           $('#calendar').fullCalendar('refetchEvents');
                        })
                     } else {
                        precio.value = null
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
