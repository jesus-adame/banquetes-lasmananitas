
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
      d_end.value = date.format()
   },
   eventClick: function (calEvent) {
      data = new FormData;
      data.append('evento_id', calEvent.id_evento)
      data.append('action', 'obtener_cotizaciones')
      
      printModalCotizacion(calEvent)

      /**---- OBTIENE TODAS LAS COTIZACIONES -----*/
      ajaxRequest('cotizacion', data)
         .then(dataJson => {
            printTableCotizacion(dataJson.data)
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