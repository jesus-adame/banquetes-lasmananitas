
$('#calendar').fullCalendar({
   header: {
      left: 'month,agendaWeek,agendaDay',
      center: 'title',
      right: 'today, prev,next'
   },
   defaultView: 'month',
   allDaySlot: false,
   eventLimit: true,
   events: 'core/ajax/eventosAjaxController.php',
   navLinks: true,
   nowIndicator: true,
   showNonCurrentDates: false,
   dayClick: function (date) {
      d_init.value = date.format()
      d_end.value  = date.format()
   },
   eventClick: function (calEvent) {
      openLoading();

      data = new FormData;
      data.append('evento_id', calEvent.id_evento)
      data.append('action', 'obtener_cotizaciones')
      
      printModalCotizacion(calEvent)

      /**---- OBTIENE TODAS LAS COTIZACIONES -----*/
      ajaxRequest('cotizacion', data)
      .then(dataJson => {
         if (typeof dataJson.data == 'undefined') {
            btn_imprimir.style.display   = 'none'
            tbody_cotizaciones.innerHTML = `<tr><td colspan="7"><button class="btn primary">Crear Cotización</botton></td></tr>`

         } else {
            btn_imprimir.style.display  = 'block'
            printTableCotizacion(dataJson.data)
         }
         closeLoading();
      })
      .then(() => {
         modal_info.style.display = 'block'
      })
   },
   views: {
      agendaWeek: { // name of view
         titleFormat: 'D MMM YYYY',
         columnHeaderFormat: 'ddd D'
      }
   }
})