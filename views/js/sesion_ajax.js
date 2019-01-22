/* Configuración de botones */

addEventListener('DOMContentLoaded', () => {
  form_sesion.addEventListener('submit', (e) => {
    e.preventDefault();
    iniciarSesion(e);
  })
})

/* Funciones de sesión */
const iniciarSesion = (event) => {
  event.preventDefault()
  openLoading();
  enviarFormSesion('iniciar');
}

const cerrarSesion = () => {
  popup.confirm({
    content: 'Se cerrará la sesión'
  },
  (clk) => {
    if (clk.proceed) {
      enviarFormSesion('cerrar');
    }
  })
}

/* Peticiones ajax */
function enviarFormSesion(accion) {
  let data = new FormData(form_sesion);
  data.append('accion', accion);

  fetch('core/ajax/sesionAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.text())
  .catch(error => {
    closeLoading();
    popup.alert({ content: 'No hay conexión\n' + error })
  })
  .then(dataText => {
    closeLoading();
    if (dataText == 'empty_fields') {
      popup.alert({ content: 'Debe llenar todos los campos', effect: 'bottom' });
      
    } else if (dataText == 'no_users') {
      popup.alert({content: 'Datos incorrectos'});

    } else if (dataText == 'success') {
      popup.alert({ content: 'Has iniciado sesión', effect: 'bottom' });
      M_sesion.style.display = 'none';
      form_sesion.reset();
      location.reload();

    } else if (dataText == 'logout') {
      location.reload();
    }
  })
}
