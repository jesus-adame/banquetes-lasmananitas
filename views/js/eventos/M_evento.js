/**
 * Escucha el click en el botón "detalle evento" del formulario
 */
addEventListener('DOMContentLoaded', () => {

  const flex = M_evento.querySelector('.flex'),
  close = M_evento.querySelector('.cerrar');

  btnDetalleEvento.addEventListener('click', e => abrirDetalleEvento());

  window.addEventListener('click', (e) => {
    if (e.target === flex || e.target === close) {
      form_evento.reset();
      M_evento.style.display = 'none';
    }
  })

  btnModificar.addEventListener('click', (e) => {
    popup.confirm({
      content: '¿Aplicar cambios?',
      effect: 'bottom'
    },
    (click) => {
      if (click.proceed) {
        modificarEvento();
      }
    });
  })

  btnBorrar.addEventListener('click', (e) => {
    popup.confirm({
      content: 'El evento se eliminará',
      effect: 'bottom'
    },
    (click) => {
      if (click.proceed) {
        eliminarEvento();
      }
    });
  })
})

function abrirEvent() { M_evento.style.display = 'block' }

function cerrarEvent()
{
  form_evento.reset();
  M_evento.style.display = 'none';
}