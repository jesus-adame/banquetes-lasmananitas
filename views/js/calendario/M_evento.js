let m_evento = document.querySelector('#M_evento')
let flex = document.querySelector('#flex')
let close = document.querySelector('#cerrar')
let form = document.querySelector('#form_evento')

close.addEventListener('click', () => {
  form.reset()
  m_evento.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == flex) {
    form.reset()
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
  form.reset()
  m_evento.style.display = 'none'
}
