
function extraerDatosEvento(calEvent) {
  
  document.querySelector('#e_id').setAttribute('value', calEvent.id_evento)
  document.querySelector('#e_title').setAttribute('value', calEvent.title)
  document.querySelector('#e_evento').setAttribute('value', calEvent.evento)
  document.querySelector('#e_contacto').setAttribute('value', calEvent.contacto)
  document.querySelector('#e_cord_resp').setAttribute('value', calEvent.cord_resp)
  document.querySelector('#e_cord_apoyo').setAttribute('value', calEvent.cord_apoyo)
  document.querySelector('#e_description').innerHTML = calEvent.description
  document.querySelector('#e_place').innerHTML = calEvent.lugar
  let select = document.querySelector('#idlugar option:first-child');
  select.setAttribute('value', calEvent.id_lugar)

  fechaHora = calEvent.start._i.split(" ")
  document.querySelector('#date_start').setAttribute('value', fechaHora[0])
  document.querySelector('#time').setAttribute('value', fechaHora[1])

  fechaHora_f = calEvent.end._i.split(" ")
  document.querySelector('#date_end').setAttribute('value', fechaHora_f[0])
  document.querySelector('#time_f').setAttribute('value', fechaHora_f[1])

  document.querySelector('#color').setAttribute('value', calEvent.color)
  document.querySelector('#old_color').setAttribute('value', calEvent.color)
  document.querySelector('#idcategoria').setAttribute('value', calEvent.categoria)
  document.querySelector('#txtcategoria').innerHTML = calEvent.categoria
  document.querySelector('#personas').setAttribute('value', calEvent.personas)
}

function limpiarDatosEvento(date) {
  document.querySelector('#e_id').setAttribute('value', '')
  document.querySelector('#e_title').setAttribute('value', '')
  document.querySelector('#e_evento').setAttribute('value', '')
  document.querySelector('#e_contacto').setAttribute('value', '')
  document.querySelector('#e_cord_resp').setAttribute('value', '')
  document.querySelector('#e_cord_apoyo').setAttribute('value', '')
  document.querySelector('#e_description').innerHTML = ''
  document.querySelector('#e_place').innerHTML = '';
  document.querySelector('#color').setAttribute('value', '#d7c735')

  let fecha = document.querySelector('#date_start');
  let fecha_final = document.querySelector('#date_end');

  fecha.setAttribute('value', date.format('YYYY-MM-DD'));
  fecha_final.setAttribute('value', date.format('YYYY-MM-DD'))

  document.querySelector('#time').setAttribute('value', '00:00:00')
  document.querySelector('#time_f').setAttribute('value', '23:00:00')

  document.querySelector('#personas').setAttribute('value', '0')
}

function arrastrarEvento(calEvent) {
  document.querySelector('#e_id').setAttribute('value', calEvent.id_evento)
  document.querySelector('#e_title').setAttribute('value', calEvent.title)
  document.querySelector('#e_evento').setAttribute('value', calEvent.evento)
  document.querySelector('#e_contacto').setAttribute('value', calEvent.contacto)
  document.querySelector('#e_cord_resp').setAttribute('value', calEvent.cord_resp)
  document.querySelector('#e_cord_apoyo').setAttribute('value', calEvent.cord_apoyo)
  document.querySelector('#e_description').innerHTML = calEvent.description
  document.querySelector('#e_place').innerHTML = calEvent.lugar
  document.querySelector('#idlugar').setAttribute('value', calEvent.id_lugar)

  fechaHora = calEvent.start.format().split('T')
  document.querySelector('#date').setAttribute('value', fechaHora[0])
  document.querySelector('#time').setAttribute('value', fechaHora[1])

  fechaHora_f = calEvent.end.format().split('T')
  document.querySelector('#date_f').setAttribute('value', fechaHora_f[0])
  document.querySelector('#time_f').setAttribute('value', fechaHora_f[1])

  document.querySelector('#categoria').setAttribute('value', calEvent.categoria)
  document.querySelector('#personas').setAttribute('value', calEvent.personas)

  recolectarDatosGUI()
  enviarInformacion('modificar', nuevoEvento)
}
