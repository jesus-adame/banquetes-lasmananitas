
/**--------------------- CLICK EN LA TABLA COTIZACION -------------*/
table_cotizacion.addEventListener('click', e => {
   let btnClass = e.target.className

   if (btnClass == 'btn primary') {
      modal_add_cot.style.display = 'block';      
   }

   if (btnClass == 'btn atention') {
      let btnId = e.target.parentElement.parentElement.dataset.item
      location.href = '?view=cargar-cotizacion&cot=' + btnId
      //open('?view=cargar-cotizacion&cot=' + btnId, '_blank');
   }

   if (btnClass == 'btn danger') {
      popup.confirm({
         content: '¿Está seguro de eliminar?',
         default_btns: {
            ok: 'SÍ', cancel: 'NO'
         }
      },
      (clck) => {
         if (clck.proceed) {
            alert('Eliminaste')
         }
      })
   }
})

/**----------------------- BOTÓN IMPRIMIR ----------------*/
/** TODO: REPARAR EL FORMATO DE LA COTIZACIÓN */
btn_imprimir.addEventListener('click', e => {
   e.preventDefault()
   let folio = e.target.dataset.folio
   open('?view=imprimir-cotizacion&folio=' + folio);
})

/**----------------------- BOTÓN ENVIAR -----------------*/

send_mail.addEventListener('click', () => {
   modal_correo.style.display = 'block'
})

/**----------------------- BOTÓN AUTORIZAR -----------------*/
/** TODO: ALTERNAR EL ESTADO DE LA COTIZACIÓN */
if (typeof btn_autorizar !== 'undefined') {
   btn_autorizar.addEventListener('click', () => {
      let dataCot = new FormData;
      dataCot.append('evento_id', evento_id.value);
      dataCot.append('action', 'obtener_cotizaciones');
      
      ajaxRequest('cotizacion', dataCot)
      .then(dataJson => {
         let estado = dataJson.data[0].estado,
            folio   = dataJson.data[0].folio;

            form_status.querySelector('input[name=folio]').value = folio;
            
         if (estado == 0) {
            status_false.checked    = 'checked'
            status_true.checked     = ''
            send_mail.style.display = 'none'

         } else if (estado == 1) {
            status_true.checked     = 'checked'
            status_false.checked    = ''
            send_mail.style.display = 'block'
         }

      }).then(() => {
         modal_status.style.display = 'block';
      })
   })
}


/*-------------------- MODAL INFO ----------------------*/

modal_info.addEventListener('click', e => {
   const m_bg = modal_info.querySelector('.m-bg'),
      m_close = modal_info.querySelector('.m-close')

   if (e.target == m_bg || e.target == m_close) {
      modal_info.style.display = 'none'
   }
})

/**------------------ MODAL STATUS --------------------*/
/** FIXME: renombrar el archivo del modal */
modal_status.addEventListener('click', e => {
   const m_bg = modal_status.querySelector('.m-bg'),
      m_close = modal_status.querySelector('.m-close');

   if (e.target == m_bg || e.target == m_close) {
      modal_status.style.display = 'none';
      form_status.reset();
   }
})

form_status.addEventListener('submit', e => {
   let dataCot = new FormData(form_status);
   dataCot.append('action', 'actualizar_estado');
   
   e.preventDefault();
   e.stopPropagation();

   ajaxRequest('cotizacion', dataCot)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({content: dataJson.msg});
         return 0;
      }
   })
   .then(() => {
      modal_status.style.display = 'none';
      cargarTablaCot(evento_id.value)
      form_status.reset();
   });
})

/**------------- MODAL CORREOS --------------------*/

modal_correo.addEventListener('click', e => {
   const m_bg = modal_correo.querySelector('.m-bg'),
      m_close = modal_correo.querySelector('.m-close')

   if (e.target == m_bg || e.target == m_close) {
      modal_correo.style.display = 'none';
   }
})

// TODO: TERMINAR DE ARMAR EL MÓDULO DE CORREOS
form_email.addEventListener('submit', e => {
   e.stopPropagation()
   e.preventDefault()
   let mailData = new FormData(form_email);
   mailData.append('action', 'enviar_email')

   ajaxRequest('cotizacion', mailData)
   .then(dataJson => {
      if (dataJson.error) {
         popup.alert({content: dataJson.msg})
      }
      console.log(dataJson)
   })
})

/**------------ MODAL ADD COT -------------*/

modal_add_cot.addEventListener('click', e => {
   const m_bg = modal_add_cot.querySelector('.m-bg'),
      m_close = modal_add_cot.querySelector('.m-close');

   if (e.target == m_bg || e.target == m_close) {
      modal_add_cot.style.display = 'none';
      form_add_cot.reset();
   }
})

form_add_cot.addEventListener('submit', e => {
   e.stopPropagation();

   let dataCot = new FormData(form_add_cot);
      dataCot.append('action', 'cotizacion_manual');
      dataCot.append('evento_id', evento_id.value);

      ajaxRequest('cotizacion', dataCot)
      .then(dataJson => {
         if (dataJson.error) {
            popup.alert({content: dataJson.msg});

         } else {
            popup.alert({content: 'Se registró la cotización'});
            modal_add_cot.style.display = 'none';
            modal_info.style.display = 'none';
            form_add_cot.reset();
         }
      });
})
