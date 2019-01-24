
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
  let start = date_start.value + ' ' + time.value,
  end = date_end.value + ' ' + time_f.value;

  if (start < end) {
    nuevoEvento = {
      id: e_id.value,
      title: e_title.value,
      evento: e_evento.value,
      contacto: e_contacto.value,
      cord_resp: e_cord_resp.value,
      cord_apoyo: e_cord_apoyo.value,
      description: e_description.value,
      id_lugar: idlugar.value,
      start: start,
      end: end,
      personas: personas.value,
      categoria: categoria.value,
      color: color.value,
      folio: e_folio.value
    }
  } else {
    popup.alert({ content: 'La fecha de finalización no puede ser anterior a la fecha de inicio' })
  }
}

function enviarInformacion(accion, objEvento) {
  $.ajax({
    type: 'POST',
    url: 'core/ajax/eventosAjaxController.php?accion=' + accion,
    data: objEvento,
    success: (r) => {
      if (r == 'empty_fields') {
        popup.alert({ content: 'Debe llenar los campos obligatorios (*)' });

      } else if (r == 'not_user') {
        popup.alert({ content: 'No tiene permiso de editar este evento' });

      } else {
        $('#calendar').fullCalendar('refetchEvents')
        cerrarEvent();
      }
    },
    error: () => {
      popup.alert({ content: 'Hay un error de conexion' })
    }
  })
}
