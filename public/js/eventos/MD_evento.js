addEventListener('DOMContentLoaded', () => {
  const md_fondo = MD_evento.querySelector('.flex'),
  btn_cancelar = MD_evento.querySelector('#cancelar'),
  btn_nueva_log = MD_evento.querySelector('#btnAgregarLogistica'),
  btn_nueva_orden = MD_evento.querySelector('#btn_agregar_orden'),
  cerrar = MD_evento.querySelector('.close'),
  tb_ordenes = MD_evento.querySelector('#tbody_orden');

  /***------------------ MODAL DETALLE EVENTO ---------------***/

  md_fondo.addEventListener('click', (e) => {
    if (e.target == md_fondo || e.target == cerrar || e.target == btn_cancelar) {
      MD_evento.style.display = 'none';
    }
  })

  /**--------------- BOTONES MODALES LOGÍSTICA Y ORDENES ---------*/
  btn_nueva_log.addEventListener('click', abrirAgregarLogistica);
  btn_nueva_orden.addEventListener('click', abrirAgregarOrden);
  
  /**---------------- ESCUCHA LA TABLA LOGÍSTICA ----------------*/
  tb_logistica.addEventListener('click', (e) => {
    let btn = e.target,
    elmnt_class = btn.className,
    id_btn = btn.getAttribute('element');

    if (elmnt_class == 'atention') {
      abrirEditarLogistica(id_btn);

    } else if (elmnt_class == 'danger') {
      abrirEliminarLogistica(id_btn);
    }
  })

  /**--------------- ESCUCHA LA TABLA ORDENES ---------------*/

  tb_ordenes.addEventListener('click', (e) => {
    const btns_add = md_orden.querySelectorAll('.success'),
    btns_edit = md_orden.querySelectorAll('.atention'),
    btns_ext = md_orden.querySelectorAll('.primary')

    let btn = e.target,
    btnClass = btn.className,
    id_btn = btn.getAttribute('orden');

    if (btnClass == 'atention') {
      btns_add.forEach(b => b.style.display = 'none')
      btns_edit.forEach(b => b.style.display = 'block')
      btns_ext.forEach(b => b.style.display = 'none')
      openModalOrdenes(id_btn)
    }

    else if (btnClass == 'danger') {
      abrirEliminarOrden(id_btn);
    }
  })
})

/*-------------------------ABRE EL MODAL ORDEN DE SERVICIO ---------------*/
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

function abrirEliminarOrden(id) {
  const form = document.querySelector('#frm_eliminar_orden'),
    input = form.querySelector('input');

  input.value = id;
  form.style.display = 'block';
}

/**----------------------ABRE MODAL DETALLE EVENTO ---------------------*/
function abrirDetalleEvento()
{
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

/*----------------------OBTENER ACTIVIDADES LOGÍSTICA-----------------*/
function obtenerLogistica(data)
{
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

/**---------------------OBTENER ORDENES DE SERVICIO ------------------*/
async function obtenerOrdenes(data)
{
  return result = await fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: data
  }).then(response => response.json());
}

/**----------------------- PINTAR TABLA LOGÍSTICA --------------------*/
function mostrarLogistica(data) {
  tb_logistica.innerHTML = '';

  for (let val of data) {
    fechahora = val.start.split(' ', 2);
    tb_logistica.innerHTML += `<tr>
      <td>${fechahora[0]}</td>
      <td>${fechahora[1]}</td>
      <td>${val.title}</td>
      <td>${val.lugar}</td>
      <td>
        <button class="atention" type="button" element="${val.id_sub_evento}">
        <i class="fas fa-pen-alt"></i>
        </button>
        <button class="danger" type="button" element="${val.id_sub_evento}">
        <i class="fas fa-trash"></i>
        </button>
      </td>
    </tr>`
  }
}

/**------------------------ PINTAR TABLA ORDENES ------------------*/
function mostrarOrdenes(data) {
  tbody_orden.innerHTML = '';

  for (let val of data) {
    fechahora = val.fecha.split(' ', 2);
    tbody_orden.innerHTML += `<tr>
      <td><a href="?view=imprimir_orden&id=${val.id_orden}" target="_blank">${val.id_orden}</a></td>
      <td>${fechahora[0]}</td>
      <td>${val.orden}</td>
      <td>${val.lugar}</td>
      <td>
      <button class="atention" type="button" orden="${val.id_orden}">
      <i class="fas fa-pen-alt"></i>
      </button>
      <button class="danger" type="button" orden="${val.id_orden}">
      <i class="fas fa-trash"></i>
      </button>
      </td>
    </tr>`
  }
}