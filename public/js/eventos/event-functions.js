
let nuevoEvento

/** ABRE EL MODAL EVENTO */
function abrirEvent() { M_evento.style.display = 'block' }

/** CERRAR EL MODAL EVENTO */
function cerrarEvent()
{
  form_evento.reset();
  M_evento.style.display = 'none';
}

/** AGREGAR EVENTO */
function addEvento() {
  recolectarDatosGUI()
  if (nuevoEvento === '') {
    popup.alert({ content: 'La fecha de finalización no puede ser anterior a la fecha de inicio' })
  } else {
    enviarInformacion('agregar', nuevoEvento)
  }
}

/** ELIMINAR EVENTO */
function eliminarEvento() {
  recolectarDatosGUI()
  enviarInformacion('eliminar', nuevoEvento)
}

/** EDITAR EVENTO */
function modificarEvento() {
  recolectarDatosGUI()
  if (nuevoEvento === '') {
    popup.alert({ content: 'La fecha de finalización no puede ser anterior a la fecha de inicio' })
    return 0;
  } else {
    enviarInformacion('modificar', nuevoEvento)
  }
}

/** CREAR OBJETO DE EVENTO */
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
    nuevoEvento = '';
  }
}

/** MANDAR DATOS DEL EVENTO POR AJAX */
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

function getIngreso(event) {
  let dataIng = new FormData;
  dataIng.append('evento_id', event.id_evento);
  dataIng.append('action', 'obtener_ingreso');

  ajaxRequest('eventos', dataIng)
  .then(totales => {
    let val = totales.ingreso[0];

    if (parseFloat(val.total) > 0)
    return val.total;

    if (parseFloat(val.renta) > 0)
    return val.renta;

    return 0;
  })
  .then(ingreso => {
    let ingreso_format = parseFloat(ingreso).toLocaleString('es-MX', formato_moneda);
    e_ingreso.value = '$ ' + ingreso_format;
  })
}