addEventListener('DOMContentLoaded', () => {

   const modal_lugar = new Modal(m_lugares);

   window.addEventListener('click', e => {
      if (e.target === modal_lugar.fondo || e.target === modal_lugar.btn_close) {
         modal_lugar.cerrar();
         form_lugares.reset();
      }
      if (e.target === add_lugar) {
         modal_lugar.abrir();
      }
   })
})