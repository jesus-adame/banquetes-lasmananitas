
function extraerDatosEvento(calEvent) {
  document.querySelector('#e_id').setAttribute('value', calEvent.id_evento)
  document.querySelector('#e_title').innerHTML = calEvent.title
  document.querySelector('#e_evento').innerHTML = calEvent.evento
  document.querySelector('#e_contacto').innerHTML = calEvent.contacto
  document.querySelector('#e_cord_resp').innerHTML = calEvent.cord_resp
  document.querySelector('#e_cord_apoyo').innerHTML = calEvent.cord_apoyo
  document.querySelector('#e_description').innerHTML = calEvent.description
  let lugar = document.querySelector('#e_place');
  lugar.innerHTML = calEvent.lugar

  fechaHora = calEvent.start._i.split(" ")
  document.querySelector('#date').innerHTML = fechaHora[0]
  document.querySelector('#time').innerHTML = fechaHora[1]

  fechaHora_f = calEvent.end._i.split(" ")
  document.querySelector('#date_f').innerHTML = fechaHora_f[0]
  document.querySelector('#time_f').innerHTML = fechaHora_f[1]

  document.querySelector('#txtcategoria').innerHTML = calEvent.categoria
  document.querySelector('#e_personas').innerHTML = calEvent.personas + 'PX'
}

function limpiarDatosEvento(date) {
  document.querySelector('#form_evento').reset()
  document.querySelector('#e_title').innerHTML = ''
  document.querySelector('#e_evento').innerHTML = ''
  document.querySelector('#e_contacto').innerHTML = ''
  document.querySelector('#e_cord_resp').innerHTML = ''
  document.querySelector('#e_cord_apoyo').innerHTML = ''
  document.querySelector('#e_description').innerHTML = ''
  document.querySelector('#e_place').innerHTML = ''

  document.querySelector('#date').innerHTML = date.format()
  document.querySelector('#date_f').innerHTML = date.format()

  document.querySelector('#time').innerHTML = '00:00:00'
  document.querySelector('#time_f').innerHTML = '00:00:00'

  document.querySelector('#e_personas').innerHTML = '';
  document.querySelector('#txtcategoria').innerHTML = '';
  abrirEvent();
}

function arrastrarEvento(calEvent) {
  document.querySelector('#e_id').setAttribute('value', calEvent.id_evento)
  document.querySelector('#e_title').innerHTML = calEvent.title
  document.querySelector('#e_evento').innerHTML = calEvent.evento
  document.querySelector('#e_contacto').innerHTML = calEvent.contacto
  document.querySelector('#e_cord_resp').innerHTML = calEvent.cord_resp
  document.querySelector('#e_cord_apoyo').innerHTML = calEvent.cord_apoyo
  document.querySelector('#e_description').innerHTML = calEvent.description
  document.querySelector('#e_place').innerHTML = calEvent.lugar

  fechaHora = calEvent.start.format().split('T')
  document.querySelector('#date').innerHTML = fechaHora[0]
  document.querySelector('#time').innerHTML = fechaHora[1]

  fechaHora_f = calEvent.end.format().split('T')
  document.querySelector('#date_f').innerHTML = fechaHora_f[0]
  document.querySelector('#time_f').innerHTML = fechaHora_f[1]

  document.querySelector('#categoria').innerHTML = calEvent.categoria
  document.querySelector('#e_personas').innerHTML = calEvent.personas

  recolectarDatosGUI()
  enviarInformacion('modificar', nuevoEvento)
}
