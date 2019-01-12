/**
 * Escucha el click en el botón "detalle evento" del formulario
 */
addEventListener('DOMContentLoaded', () => {

  const flex = M_evento.querySelector('.flex'),
  close = M_evento.querySelector('.cerrar');

  btnDetalleEvento.addEventListener('click', e => abrirDetalleEvento());

  close.addEventListener('click', () => {
    form_evento.reset();
    M_evento.style.display = 'none';
  })

  window.addEventListener('click', (e) => {
    if (e.target == flex) {
      form_evento.reset();
      M_evento.style.display = 'none';
    }
  })
})

function abrirEvent() { M_evento.style.display = 'block' }

function cerrarEvent()
{
  form_evento.reset();
  M_evento.style.display = 'none';
}