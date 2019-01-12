const m_evento = document.querySelector('#M_evento');

cerrar.addEventListener('click', () => {
  form_evento.reset()
  m_evento.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == flex) {
    form_evento.reset()
    m_evento.style.display = 'none'
  }
})

function abrirEvent()
{
  let content;
  m_evento.style.display = 'block'
}

function cerrarEvent()
{
  form_evento.reset()
  m_evento.style.display = 'none'
}
