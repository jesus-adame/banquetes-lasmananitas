
table_cotizacion.addEventListener('click', e => {
   let btnClass = e.target.className

   if (btnClass == 'btn primary') {
      console.log('agregar')
      location.href = '?view=cargar-cotizacion';
   }

   if (btnClass == 'btn atention') {
      let btnId = e.target.parentElement

      console.log('editar', btnId)
      location.href = '?view=cargar-cotizacion';
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

/*-------------------- MODAL INFO ----------------------*/

modal_info.addEventListener('click', e => {
   const m_bg = modal_info.querySelector('.m-bg'),
      m_close = modal_info.querySelector('.m-close')

   if (e.target == m_bg || e.target == m_close) {
      modal_info.style.display = 'none'
   }
})