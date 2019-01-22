
var nuevoEvento

function addEvento() {
  recolectarDatosGUI()
  enviarInformacion('agregar', nuevoEvento)
}

function eliminarEvento() {
  recolectarDatosGUI()
  enviarInformacion('eliminar', nuevoEvento)
}

function modificarEvento() {
  recolectarDatosGUI()
  enviarInformacion('modificar', nuevoEvento)
}

function recolectarDatosGUI() {
  nuevoEvento = {
    id: $('#e_id').val(),
    title: $('#e_title').val(),
    evento: $('#e_evento').val(),
    contacto: $('#e_contacto').val(),
    cord_resp: $('#e_cord_resp').val(),
    cord_apoyo: $('#e_cord_apoyo').val(),
    description: $('#e_description').val(),
    id_lugar: $('#e_idplace').val(),
    start: $('#date').val() + ' ' + $('#time').val(),
    end: $('#date_f').val() + ' ' + $('#time_f').val(),
    personas: $('#personas').val(),
    categoria: $('#categoria').val(),
    color: $('#color').val()
  }
}

function enviarInformacion(accion, objEvento) {
  $.ajax({
    type: 'POST',
    url: 'core/ajax/eventosAjaxController.php?accion=' + accion,
    data: objEvento,
    success: function(r) {
      if (r) {
        $('#calendar').fullCalendar('refetchEvents')
        cerrarEvent()
      } else {
        alert('No se pudo realizar la operacion')
      }
    },
    error: () => {
      popup.alert({ content: 'Hay un error en la conexión' })
    }

  })
}
