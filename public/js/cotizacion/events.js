
/**--------------------- CLICK EN LA TABLA COTIZACION -------------*/
table_cotizacion.addEventListener('click', e => {
   let btnClass = e.target.className

   if (btnClass == 'btn primary') {
      console.log('agregar')
      //open('?view=cargar-cotizacion');
   }

   if (btnClass == 'btn default') {
      let btnId = e.target.parentElement.parentElement.dataset.item
      console.log(btnId)
      location.href = '?view=cargar-cotizacion&cot=' + btnId
      //open('?view=cargar-cotizacion&cot=' + btnId, '_blank');
   }

   if (btnClass == 'btn atention') {
      modal_options.style.display = 'block'
   }

   if (btnClass == 'btn danger') {
      console.log('borrar')
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

btn_imprimir.addEventListener('click', e => {
   e.preventDefault()
   let folio = e.target.dataset.folio
   location.href = '?view=imprimir-cotizacion&folio=' + folio;
})

/**----------------------- BOTÓN ENVIAR -----------------*/

send_mail.addEventListener('click', () => {
   alert('enviar')
})

/*-------------------- MODAL INFO ----------------------*/

modal_info.addEventListener('click', e => {
   const m_bg = modal_info.querySelector('.m-bg'),
      m_close = modal_info.querySelector('.m-close')

   if (e.target == m_bg || e.target == m_close) {
      modal_info.style.display = 'none'
   }
})

/**------------------ MODAL OPTIONS --------------------*/

modal_options.addEventListener('click', e => {
   const m_bg = modal_options.querySelector('.m-bg'),
      m_close = modal_options.querySelector('.m-close')

   if (e.target == m_bg || e.target == m_close) {
      modal_options.style.display = 'none'
   }
})