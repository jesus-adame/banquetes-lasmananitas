$('#calendar').fullCalendar({
  header: {
    left: 'listYear,month,agendaWeek,agendaDay',
    center: 'title',
    right: 'today, btnAgregar, prev,next'
  },
  defaultView: 'month',
  eventLimit: true,
  events: 'core/ajax/eventosAjaxController.php',
  eventClick: function(calEvent, jsEvent, view) {
    
    if (calEvent.evento != null && view.name == 'month') {
      extraerDatosEvento(calEvent);
      abrirEvent();
    }
  }
})

