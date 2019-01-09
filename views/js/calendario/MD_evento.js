let md_evento = document.querySelector('#MD_evento')
let mde_close = document.querySelector('#mde_cerrar')

mde_close.addEventListener('click', () => {
  md_evento.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == document.querySelector('#DE_flex')) {
    md_evento.style.display = 'none'
  }
})

function abrirDetalleEvento()
{
  let btn_detalle = document.querySelector('#e_id').value
  let data = new FormData()

  data.append('id', btn_detalle)

  ajaxLogistica(data)

  ajaxOrdenes(data)
  .then(dataJson => {
    mostrarOrdenes(dataJson)
    md_evento.style.display = 'block'
  })

}

function ajaxLogistica(data)
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

async function ajaxOrdenes(data)
{
  return result = fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => {
    return response.json()
  })
}

function mostrarLogistica(data) {
  tb_logistica.innerHTML = ''

  for (let val of data) {
    fechahora = val.start.split(' ', 2)
    tb_logistica.innerHTML += `<tr>
      <td>${fechahora[0]}</td>
      <td>${fechahora[1]}</td>
      <td>${val.title}</td>
      <td>${val.lugar}</td>
    </tr>`
  }
}

function mostrarOrdenes(data) {
  tbody_orden.innerHTML = '';

  for (let val of data) {
    fechahora = val.fecha.split(' ', 2)
    tbody_orden.innerHTML += `<tr>
      <td>${val.id_orden}</td>
      <td>${fechahora[0]}</td>
      <td>${val.orden}</td>
      <td>${val.lugar}</td>
      <td>
        <a class="btn atention" href="?view=imprimir_orden&id=${val.id_orden}" target="_black">
        <i class="fas fa-print"></i>
        </a>
      </td>
    </tr>`
  }
}

function cancelarDetalleEvento()
{
  md_evento.style.display = 'none'
}
