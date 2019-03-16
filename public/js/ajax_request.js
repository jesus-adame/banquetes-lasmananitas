async function peticionAjax(url, accion, formData) {
   formData.append('action', accion);

   return result = await fetch(url, {
      method: 'POST',
      body: formData
   })
   .then(response => response.json())
   .catch(error => {
      console.log('Hubo un error ', error.message);
   })
}

function obtenerDatos(tabla) {
   let data = new FormData();
   data.append('tabla', tabla);

   return res = fetch('core/ajax/obtenerDatos.php', {
      method: 'POST',
      body: data
   })
   .then(response => response.json())
}

function obtenerDatosDonde(tabla, campo, valor) {
   let data = new FormData();
   data.append('tabla', tabla);
   data.append('campo', campo);
   data.append('valor', valor);

   return res = fetch('core/ajax/verRegistro.php', {
      method: 'POST',
      body: data
   })
   .then(response => response.json())
}

function obtenerDatosOrden(tabla, campo, valor = 'ASC') {
   let data = new FormData();
   data.append('tabla', tabla);
   data.append('campo', campo);
   data.append('valor', valor);
   data.append('orden', true);

   return res = fetch('core/ajax/verRegistro.php', {
      method: 'POST',
      body: data
   })
      .then(response => response.json())
}

function obtenerDatosJoinJoin(tabla, tabla2, on, tabla3 = '', on2 = '') {
   let data = new FormData();
   data.append('tabla', tabla);
   data.append('tabla2', tabla2);
   data.append('on', on);
   data.append('tabla3', tabla3);
   data.append('on2', on2);

   return res = fetch('core/ajax/obtenerDatos.php', {
      method: 'POST',
      body: data
   })
   .then(response => response.json())
}