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
	.then(response => response.json())
	.catch(error => {
		closeLoading();
		popup.alert({ content: 'No hay conexión\n' + error });
	})
	.then(dataJson => {
		closeLoading();
		if (dataJson.error) {
			throw dataJson;
		}
		M_sesion.style.display = 'none';
		form_sesion.reset();
		location.reload();
	})
	.catch(error => {
		popup.alert({ content: error.msg });
	})
}
