const m_evento = document.querySelector('#M_evento');

window.addEventListener('click', (e) => {
   if (e.target === flex || e.target === cerrar) {
      cerrarEvent();
   }
})

function abrirEvent()
{
  m_evento.style.display = 'block';
  closeLoading();
}

function cerrarEvent()
{
  form_evento.reset()
  m_evento.style.display = 'none'
}
