/* Configuración de botones */
(() => {
  const form_sesion = document.querySelector('#form_sesion')

  form_sesion.addEventListener('submit', (e) => {
    iniciarSesion(e)
  })
})()

/* Funciones de sesión */
var iniciarSesion = (event) => {
  event.preventDefault()
  enviarFormSesion('iniciar')
}

var cerrarSesion = () => {
  enviarFormSesion('mostrar')
}

/* Peticiones ajax */

function enviarFormSesion(accion)
{
  const form = document.querySelector('#form_sesion');
  let data = new FormData(form_sesion)
  data.append('accion', accion)

  fetch('core/ajax/sesionAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.text())
  .then(dataText => {
    if (dataText == 'empty_fields') {
      alert('Debe llenar todos los campos')
    } else if (dataText == 'no_users') {
      alert('Datos incorrectos');
    } else if (dataText == 'success') {
      alert('Has iniciado sesión')
      cerrarMSesion();
      form.reset();
      location.reload();
    } else if (dataText == 'logout') {
      alert('Has cerrado la sesión')
      location.reload()
    } else {
      alert('Ha ocurrido un error')
    }
  })
}
