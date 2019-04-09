/**
 * Escucha el click en el botón "detalle evento" del formulario
 */
addEventListener('DOMContentLoaded', () => {
  const flex = M_evento.querySelector('.flex'),
    close    = M_evento.querySelector('.cerrar');

  btnDetalleEvento.addEventListener('click', e => abrirDetalleEvento());

  /** ESCUCHA EL FONDO */
  window.addEventListener('click', (e) => {
    if (e.target === flex || e.target === close) {
      form_evento.reset();
      M_evento.style.display = 'none';
    }
  });

  /** BTN MODIFICAR */
  btnModificar.addEventListener('click', (e) => {
    popup.confirm({
      content: '<b>Modificar</b><br><br>¿Aplicar cambios?',
      default_btns: {
         ok: 'SÍ',
         cancel: 'NO'
      }
    },
    (click) => {
      if (click.proceed) {
        modificarEvento();
      }
    });
  })

  /** BTN BORRAR */
  btnBorrar.addEventListener('click', (e) => {
    popup.confirm({
      content: '<strong>Eliminar</strong><br><br>¿Está seguro?',
      default_btns: {
         ok: 'SÍ',
         cancel: 'NO'
      }
    },
    (click) => {
      if (click.proceed) {
        eliminarEvento();
      }
    });
  });
});