let md_logistica = document.querySelector('#md_logistica')
let mdl_close = document.querySelector('#mdl_cerrar')
const fd_logistica = document.querySelector('#fd_logistica')
let id_evento = document.querySelector('#e_id').value

mdl_close.addEventListener('click', () => {
  md_logistica.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == document.querySelector('#mdl_flex')) {
    md_logistica.style.display = 'none'
  }
})

function abrirDetalleLogistica()
{
  md_logistica.style.display = 'block'
}

function addLogistica() {
  var LogDatos = new FormData(fd_logistica);

  logDatos.append('accion', 'agregar');
  logDatos.append('id_evento', id_evento);

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: LogDatos
  })
  .then(response => response.text())
  .then(dataText => {
    console.log(dataText);
  })
}

function editLogistica() {
  LogDatos = new FormData(fd_logistica);

  logDatos.append('accion', 'editar');

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: LogDatos
  })
  .then(response => response.text())
  .then(dataText => {
    console.log(dataText);
  })
}

function eliminarLogistica() {
  let LogDatos = new FormData(fd_logistica);

  logDatos.append('accion', 'eliminar');

  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: LogDatos
  })
  .then(response => response.text())
  .then(dataText => {
    console.log(dataText);
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
  md_logistica.style.display = 'none'
}
