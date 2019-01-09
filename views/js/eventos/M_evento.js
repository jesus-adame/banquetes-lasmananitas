const m_evento = document.querySelector('#M_evento'),
flex = m_evento.querySelector('.flex'),
close = m_evento.querySelector('.cerrar'),
form_evento = m_evento.querySelector('#form_evento');

close.addEventListener('click', () => {
  form_evento.reset();
  m_evento.style.display = 'none';
})

window.addEventListener('click', (e) => {
  if (e.target == flex) {
    form_evento.reset();
    m_evento.style.display = 'none';
  }
})

function abrirEvent()
{
  m_evento.style.display = 'block'; 
}

function cerrarEvent()
{
  form_evento.reset();
  m_evento.style.display = 'none';
}

/**
 * Escucha el click en el botón "detalle evento" del formulario
 */
addEventListener('DOMContentLoaded', () => {
  const btnDetalleEvent = document.querySelector('#btnDetalleEvento');

  btnDetalleEvent.addEventListener('click', e => {
    e.stopPropagation();
    abrirDetalleEvento();
  });
})