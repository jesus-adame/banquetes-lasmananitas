let m_sesion = document.querySelector('#M_sesion')
let ms_flex = document.querySelector('#MS_flex')
let ms_close = document.querySelector('#MS_cerrar')

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
