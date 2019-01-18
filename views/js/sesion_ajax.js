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
  enviarFormSesion('iniciar');
}

const cerrarSesion = () => {
  mcxDialog.confirm('Se cerrará la sesión', {
    sureBtnClick: () => {
      enviarFormSesion('mostrar');
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
  .then(dataText => {
    if (dataText == 'empty_fields') {
      mcxDialog.alert('Debe llenar todos los campos');
      
    } else if (dataText == 'no_users') {
      mcxDialog.alert('Datos incorrectos');

    } else if (dataText == 'success') {
      mcxDialog.alert('Has iniciado sesión');
      cerrarMSesion();
      form_sesion.reset();
      location.reload();

    } else if (dataText == 'logout') {
      location.reload();
    } else {
      mcxDialog.alert('Ha ocurrido un error');
    }
  })
}
