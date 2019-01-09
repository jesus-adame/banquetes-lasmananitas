
let nuevoEvento

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
  let start = $('#date_start').val() + ' ' + $('#time').val();
  let end = $('#date_end').val() + ' ' + $('#time_f').val();

  if (start < end) {
    nuevoEvento = {
      id: $('#e_id').val(),
      title: $('#e_title').val(),
      evento: $('#e_evento').val(),
      contacto: $('#e_contacto').val(),
      cord_resp: $('#e_cord_resp').val(),
      cord_apoyo: $('#e_cord_apoyo').val(),
      description: $('#e_description').val(),
      id_lugar: $('#idlugar').val(),
      start: start,
      end: end,
      personas: $('#personas').val(),
      categoria: $('#categoria').val(),
      color: $('#color').val()
    }
  } else {
    alert('La fecha de finalización no puede ser anterior a la fecha de inicio')
  }
}

function enviarInformacion(accion, objEvento) {
  $.ajax({
    type: 'POST',
    url: 'core/ajax/eventosAjaxController.php?accion=' + accion,
    data: objEvento,
    success: function(r) {
      if (r == 'empty_fields') {
        alert('Debe llenar los campos obligatorios (*)');
        console.log(r)

      } else if (r == 'not_user') {
        alert('No tiene permiso de editar este evento');
        console.log(r)

      } else {
        $('#calendar').fullCalendar('refetchEvents')
        cerrarEvent();
      }
    },
    error: function() {
      alert('Hay un error')
    }

  })
}
