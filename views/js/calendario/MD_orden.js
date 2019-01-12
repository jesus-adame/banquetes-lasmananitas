const mdo_fondo = md_orden.querySelector('.flex');

mdo_cerrar.addEventListener('click', () => {
  md_orden.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == mdo_fondo) {
    md_orden.style.display = 'none'
  }
})

function abrirDetalleOrden()
{
  md_orden.style.display = 'block'
}

function addOrden() {
  alert('se envió la orden')
}

function ajaxOrdenes(data)
{
  fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => {
    return response.json()
  })
  .then(dataJson => {
    mostrarOrdenes(dataJson)
  })
}

function cancelarDetalleOrden()
{
  md_orden.style.display = 'none'
}
