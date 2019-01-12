const md_logistica = document.querySelector('#md_logistica'),
mdl_close = document.querySelector('#mdl_cerrar'),
fondo_mdl = md_logistica.querySelector('.flex'),
id_evento = document.querySelector('#e_id'),
btn_edit = document.querySelector('#btn_edit_log'),
btn_add = document.querySelector('#btn_add_log');

window.addEventListener('click', (e) => {
  if (e.target == fondo_mdl || e.target == mdl_close) {
    md_logistica.style.display = 'none'
    document.querySelector('#form_logistica').reset();
  }
})

/** Modal BORRAR logistica */

const m_borrar = document.querySelector('#f_eliminar_log');
(() => {  
  const fondo_borrar = m_borrar.querySelector('.flex'),
  frm_borrar = m_borrar.querySelector('form'),
  cerrar_borrar = m_borrar.querySelector('.cerrar');

  window.addEventListener('click', (e) => {
    if (e.target == fondo_borrar || e.target == cerrar_borrar) {
      m_borrar.style.display = 'none';
      frm_borrar.reset();
    }
  })
})()

function abrirAgregarLogistica()
{
  let fecha = document.querySelector('#date_start').value,
  hora = document.getElementById('time').value;
  
  btn_edit.style.display = 'none';
  btn_add.style.display = 'block';
  md_logistica.style.display = 'block';
  document.querySelector('#fecha_edit_log').value = fecha
  document.querySelector('#fecha_f_edit_log').value = fecha
  document.getElementById('time_start_log').value = hora
}

function abrirEditarLogistica(id)
{
  md_logistica.style.display = 'block';
  
  btn_add.style.display = 'none';
  btn_edit.style.display = 'block';
  obtenerDatosLog(id);
  
  document.querySelector('#id_edit_log').value = id;
}

function abrirEliminarLogistica(id)
{
  m_borrar.style.display = 'block'
  document.querySelector('#id_elim_log').value = id
}

function addLogistica() {
  let form = document.querySelector('#form_logistica'),
  logDatos = new FormData(form);

  logDatos.append('accion', 'agregar');
  logDatos.append('id_evento', id_evento.value);

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: logDatos
  })
  .then(response => response.json())
  .then(dataJson => {
    
    if (dataJson == 'success') {
      $('#calendar').fullCalendar('refetchEvents');
      let log = new FormData(),
      md_logis = document.querySelector('#md_logistica');

      log.append('id', id_evento.value);
      obtenerLogistica(log);
      md_logis.style.display = 'none';
      form.reset();

    } else if (dataJson == 'empty_fields') {
      alert('Debe ingresar un titulo');

    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de editar este evento');
    }
  })
}

function editLogistica() {
  let form = document.querySelector('#form_logistica');
  let logDatos = new FormData(form);

  logDatos.append('accion', 'modificar');

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: logDatos
  })
  .then(response => response.json())
  .then(dataJson => {

    if (dataJson == 'success') {
      $('#calendar').fullCalendar('refetchEvents')
      let log = new FormData();

      log.append('id', id_evento.value)
      obtenerLogistica(log)
      md_logistica.style.display = 'none'
      form.reset();

    } else if (dataJson == 'empty_fields') {
      alert('Debe ingresar un titulo');
    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de editar este evento');
    }
  })
}

function mostrarDatosLog(data) {
  fetch('core/ajax/verRegistro.php', {
    method: 'POST',
    body: data
  })
  .then(response => {
    return response.json()
  })
  .then(dataJson => {
    mostrarDatosLog(dataJson)
  })
}

function eliminarLogistica() {
  const form = document.querySelector('#form_eliminar_logistica'),
  m_borrar = document.querySelector('#f_eliminar_log');
  let logDatos = new FormData(form);
  
  logDatos.append('accion', 'eliminar');
  logDatos.append('id_evento', id_evento.value);

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: logDatos
  })
  .then(response => response.json())
  .then(dataJson => {

    if (dataJson == 'success') {
      $('#calendar').fullCalendar('refetchEvents')
      let log = new FormData();
      
      log.append('id', id_evento.value)
      obtenerLogistica(log)
      m_borrar.style.display = 'none';
    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de modificar este evento');
    } 
  })
}

function ajaxDetalleLogistica(data)
{
  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => {
    return response.json()
  })
  .then(dataJson => {
    mostrarLogistica(dataJson)
  })
}

function cancelarDetalleLogistica()
{
  document.querySelector('#form_logistica').reset();
  md_logistica.style.display = 'none'
}

function obtenerDatosLog(id) {
  let data = new FormData();
  data.append('accion', 'obtener');
  data.append('id', id);

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(dataJson => {
    let activ = document.querySelector('#actividad_log');
    let lugar = document.querySelector('#lugar_log');
    let id_log = document.querySelector('#id_edit_log');
    let id_evento = document.querySelector('#id_evento');
    let fecha = document.querySelector('#fecha_edit_log')
    let fecha_f = document.querySelector('#fecha_f_edit_log')
    let time = document.querySelector('#time_start_log')
    let time_f = document.querySelector('#time_f_log')

    for (let i in dataJson) {
      let item = dataJson[i];
      let date = item.start.split(' ');
      let date_f = item.end.split(' ');

      activ.value = item.title;
      lugar.value = item.lugar;
      id_log.value = item.id_sub_evento;
      id_evento.value = item.id_evento;
      fecha.value = date[0];
      fecha_f.value = date_f[0];
      time.value = date[1];
      time_f.value = date_f[1];
    }
  })
}