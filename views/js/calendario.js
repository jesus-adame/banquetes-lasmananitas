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

    const btnAddEvent = document.querySelector('#btnAgregarEvento'),
    btnModificar = document.querySelector('#btnModificar'),
    btnBorrar = document.querySelector('#btnBorrar'),
    btnDetalleEvent = document.querySelector('#btnDetalleEvento');

    if (calEvent.color != '#e62424') {

      btnModificar.removeAttribute('disabled');
      btnBorrar.removeAttribute('disabled');
      btnDetalleEvent.removeAttribute('disabled');
      btnAddEvent.setAttribute('disabled', 'disabled');

    } else {
      btnModificar.setAttribute('disabled', 'disabled');
      btnBorrar.setAttribute('disabled', 'disabled');
      btnDetalleEvent.removeAttribute('disabled');
      btnAddEvent.setAttribute('disabled', 'disabled');
    }
    
    if (calEvent.evento != null && view.name == 'month') {
      extraerDatosEvento(calEvent);
      abrirEvent();
    }
  },
  dayClick: function(date, jsEvent, view) {
    if (view.name == 'month') {
      
      limpiarDatosEvento(date);
      $('#btnBorrar').prop('disabled', true);
      $('#btnModificar').prop('disabled', true);
      $('#btnDetalleEvento').prop('disabled', true);
      $('#btnAgregarEvento').prop('disabled', false);
      
      abrirEvent();
      document.getElementById('M_evento').querySelectorAll('input')[1].focus();
    }
  }
})

