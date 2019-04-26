
/**-----------------ABRE MODAL DETALLE EVENTO ----------------*/
function abrirDetalleEvento() {
	let id_evento = e_id.value,
		data = new FormData();

	data.append('id', id_evento); // Se agrega el id del evento clickeado

	// Muestra los datos en el formulario
	openLoading();
	obtenerLogistica(data);

	obtenerOrdenes(data)
		.then(dataJson => {
			mostrarOrdenes(dataJson);
			closeLoading();
			MD_evento.style.display = 'block';
		})
}

/*---------------- OBTENER ACTIVIDADES LOGÍSTICA --------------*/
function obtenerLogistica(data) {
	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: data
	})
		.then(response => response.json())
		.catch(error => popup.alert({ content: 'No hay conexión\n' + error }))
		.then(dataJson => {
			mostrarLogistica(dataJson);
		})
}

/**----------------- OBTENER ORDENES DE SERVICIO ------------------*/
async function obtenerOrdenes(data) {
	return result = await fetch('core/ajax/ordenesAjaxController.php', {
		method: 'POST',
		body: data
	}).then(response => response.json());
}

/*----------------- ABRE EL MODAL ORDEN DE SERVICIO ---------------*/
function abrirAgregarOrden() {
	const tabs = md_orden.querySelectorAll('.tab'),
		btns_agregar = md_orden.querySelectorAll('.success'),
		btns_editar = md_orden.querySelectorAll('.atention'),
		btns_mas = md_orden.querySelectorAll('.primary');

	/** Permite abrir las tabs con la primer pestaña en click */
	tabs[0].click();

	tabs.forEach(tab => {
		tab.removeAttribute('style');
		tab.style.color = '#1b1b1b';
	});

	for (let i = 0; i < btns_agregar.length; i++) {
		btns_agregar[i].style.display = 'block';
		btns_editar[i].style.display = 'none';
		btns_mas[i].style.display = 'block';
	}
	md_orden.style.display = 'block';
}

/*------------ CARGA EL FORMULARIO ORDEN DE SERVICIO -----------*/
function openModalOrdenes(id) {
	let dataOrden = new FormData;
	dataOrden.append('id', id)
	dataOrden.append('action', 'obtener_una_orden')

	openLoading();
	/** PINTA EL MODAL DE ORDEN */
	ajaxRequest('eventos', dataOrden)
		.then(dataJson => {
			printModalOrden(dataJson.data[0])
		})
		.then(() => {
			closeLoading();
			md_orden.style.display = 'block';
		})
}

/**--- ABRIR MODAL LOGÍSTICA ----*/
function abrirAgregarLogistica() {
	let fecha = document.querySelector('#date_start').value,
		hora = document.getElementById('time').value;

	btn_edit.style.display = 'none';
	btn_add.style.display = 'block';
	md_logistica.style.display = 'block';
	fecha_edit_log.value = fecha;
	time_start_log.value = hora;
	id_evento.value = e_id.value;
}

/**---- ABRIR EDITAR LOGISTICA ----*/
function abrirEditarLogistica(id) {
	md_logistica.style.display = 'block';

	btn_add.style.display = 'none';
	btn_edit.style.display = 'block';
	obtenerDatosLog(id);

	id_edit_log.value = id;
	id_evento.value = e_id;
}

// TODO: ACTUALIZAR LAS PETICIONES AJAX
/**---- AGREGAR LOGÍSTICA ----*/
function addLogistica() {
	let logDatos = new FormData(form_logistica);
	logDatos.append('accion', 'agregar');

	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: logDatos
	})
		.then(response => response.json())
		.catch(error => popup.alert({ content: 'No hay conexión\n' + error }))
		.then(dataJson => {
			if (dataJson.error) {
				throw dataJson;
			}

			/** ACTUALIZA LAS ACTIVIDADES */
			$('#calendar').fullCalendar('refetchEvents');
			let log = new FormData(),
				md_logis = document.querySelector('#md_logistica');

			log.append('id', id_evento.value);
			obtenerLogistica(log);
			md_logis.style.display = 'none';
			form_logistica.reset();
		})
		.catch(error => {
			popup.alert({ content: error.msg });
		})
}

/**---- EDITAR LOGÍSTICA ----*/
function editLogistica() {
	let logDatos = new FormData(form_logistica);
	logDatos.append('accion', 'modificar');

	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: logDatos
	})
		.then(response => response.json())
		.catch(error => popup.alert({ content: 'No hay conexión\n' + error }))
		.then(dataJson => {
			if (dataJson.error) {
				throw dataJson;
			}

			/** ACTUALIZA LAS ACTIVIDADES */
			$('#calendar').fullCalendar('refetchEvents');
			let log = new FormData(),
				md_logis = document.querySelector('#md_logistica');

			log.append('id', id_evento.value);
			obtenerLogistica(log);
			md_logis.style.display = 'none';
			form_logistica.reset();
		})
		.catch(error => {
			popup.alert({ content: error.msg });
		})
}

/**---- ELIMINAR LOGÍSTICA ----*/
function eliminarLogistica() {
	const form = document.querySelector('#form_eliminar_logistica');
	let logDatos = new FormData(form);

	logDatos.append('accion', 'eliminar');
	logDatos.append('id_evento', e_id.value);

	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: logDatos
	})
		.then(response => response.json())
		.catch(error => popup.alert({ content: 'No hay conexión\n' + error }))
		.then(dataJson => {
			if (dataJson.error) {
				throw dataJson;
			}

			/** ACTUALIZA LAS ACTIVIDADES */
			$('#calendar').fullCalendar('refetchEvents');
			let log = new FormData();

			f_eliminar_log.style.display = 'none';
			log.append('id', id_evento.value);
			obtenerLogistica(log);
		})
		.catch(error => {
			popup.alert({ content: error.msg });
		})
}

/**---- MOSTRAR DATOS LOGÍSTICA ----*/
function mostrarDatosLog(data) {
	fetch('core/ajax/verRegistro.php', {
		method: 'POST',
		body: data
	})
		.then(response => response.json())
		.then(dataJson => {
			mostrarDatosLog(dataJson)
		})
}

/**---- ENVIAR DETALLE LOGÍSTICA ----*/
function ajaxDetalleLogistica(data) {
	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: data
	})
		.then(response => response.json())
		.catch(error => popup.alert({ content: 'No hay conexión\n' + error }))
		.then(dataJson => {
			mostrarLogistica(dataJson)
		})
}

/**---- OBTENER DATOS DE UNA ACTIVIDAD ----*/
function obtenerDatosLog(id) {
	let data = new FormData();
	data.append('accion', 'obtener');
	data.append('id', id);

	fetch('core/ajax/logisticaAjaxController.php', {
		method: 'POST',
		body: data
	})
		.then(response => response.json())
		.then(dataJson => {
			const activ = document.querySelector('#actividad_log');
			lugar = document.querySelector('#lugar_log'),
				id_log = document.querySelector('#id_edit_log'),
				fecha = document.querySelector('#fecha_edit_log'),
				fecha_f = document.querySelector('#fecha_f_edit_log'),
				time = document.querySelector('#time_start_log'),
				time_f = document.querySelector('#time_f_log');

			for (let i in dataJson) {
				let item = dataJson[i],
					date = item.start.split(' ');

				activ.value = item.title;
				lugar.value = item.lugar;
				id_log.value = item.id_sub_evento;
				id_evento.value = item.id_evento;
				fecha.value = date[0];
				time.value = date[1];
			}
		})
}