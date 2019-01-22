
function extraerDatosEvento(calEvent) {
  
  e_id.setAttribute('value', calEvent.id_evento)
  e_title.setAttribute('value', calEvent.title)
  e_evento.setAttribute('value', calEvent.evento)
  e_contacto.setAttribute('value', calEvent.contacto)
  e_cord_resp.setAttribute('value', calEvent.cord_resp)
  e_cord_apoyo.setAttribute('value', calEvent.cord_apoyo)
  e_description.innerHTML = calEvent.description
  e_place.innerHTML = calEvent.lugar
  let select = document.querySelector('#idlugar option:first-child');
  select.setAttribute('value', calEvent.id_lugar)

  fechaHora = calEvent.start._i.split(" ")
  date_start.setAttribute('value', fechaHora[0])
  time.setAttribute('value', fechaHora[1])

  fechaHora_f = calEvent.end._i.split(" ")
  date_end.setAttribute('value', fechaHora_f[0])
  time_f.setAttribute('value', fechaHora_f[1])

  color.setAttribute('value', calEvent.color)
  old_color.setAttribute('value', calEvent.color)
  idcategoria.setAttribute('value', calEvent.categoria)
  txtcategoria.innerHTML = calEvent.categoria
  personas.setAttribute('value', calEvent.personas)
}

function limpiarDatosEvento(date) {
  e_id.setAttribute('value', '')
  e_title.setAttribute('value', '')
  e_evento.setAttribute('value', '')
  e_contacto.setAttribute('value', '')
  e_cord_resp.setAttribute('value', '')
  e_cord_apoyo.setAttribute('value', '')
  e_description.innerHTML = ''
  e_place.innerHTML = '';
  color.setAttribute('value', '#d7c735')

  let fecha = date_start,
  fecha_final = date_end;

  fecha.setAttribute('value', date.format('YYYY-MM-DD'));
  fecha_final.setAttribute('value', date.format('YYYY-MM-DD'))

  time.setAttribute('value', '00:00:00')
  time_f.setAttribute('value', '23:00:00')

  personas.setAttribute('value', '0')
}

function arrastrarEvento(calEvent) {
  e_id.setAttribute('value', calEvent.id_evento)
  e_title.setAttribute('value', calEvent.title)
  e_evento.setAttribute('value', calEvent.evento)
  e_contacto.setAttribute('value', calEvent.contacto)
  e_cord_resp.setAttribute('value', calEvent.cord_resp)
  e_cord_apoyo.setAttribute('value', calEvent.cord_apoyo)
  e_description.innerHTML = calEvent.description
  e_place.innerHTML = calEvent.lugar
  idlugar.setAttribute('value', calEvent.id_lugar)

  fechaHora = calEvent.start.format().split('T')
  date.setAttribute('value', fechaHora[0])
  time.setAttribute('value', fechaHora[1])

  fechaHora_f = calEvent.end.format().split('T')
  date_f.setAttribute('value', fechaHora_f[0])
  time_f.setAttribute('value', fechaHora_f[1])

  categoria.setAttribute('value', calEvent.categoria)
  personas.setAttribute('value', calEvent.personas)

  recolectarDatosGUI()
  enviarInformacion('modificar', nuevoEvento)
}
