let m_sesion = document.querySelector('#M_sesion'),
ms_flex = document.querySelector('.flex'),
ms_close = document.querySelector('.close');

ms_close.addEventListener('click', () => {
  m_sesion.style.display = 'none'
})

window.addEventListener('click', (e) => {
  if (e.target == ms_flex) {
    m_sesion.style.display = 'none'
  }
})

function abrirMSesion()
{
  m_sesion.style.display = 'block'
  m_sesion.querySelectorAll('input')[0].focus()
}

function cerrarMSesion()
{
  m_sesion.style.display = 'none'
}
