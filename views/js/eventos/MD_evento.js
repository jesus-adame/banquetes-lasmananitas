addEventListener('DOMContentLoaded', () => {
  const md_evento = document.querySelector('#MD_evento'),
  md_fondo = md_evento.querySelector('.flex'),
  btn_cancelar = md_evento.querySelector('#cancelar'),
  btn_nueva_log = md_evento.querySelector('#btnAgregarLogistica'),
  btn_nueva_orden = md_evento.querySelector('#btn_agregar_orden'),
  cerrar = md_evento.querySelector('.close'),
  tb_logistica = md_evento.querySelector('#tb_logistica'),
  tb_ordenes = md_evento.querySelector('#tbody_orden');

  /*** Funciones para cerrar el modal ***/

  md_fondo.addEventListener('click', (e) => {
    if (e.target == md_fondo) {
      return md_evento.style.display = 'none';
    }
  })

  /** Se escucha la tabla logistica */
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


  /** Se escucha la tabla ordenes */
  tb_ordenes.addEventListener('click', (e) => {
    let btn = e.target,
    elmnt_class = btn.className,
    id_btn = btn.getAttribute('orden');

    if (elmnt_class == 'atention') {
      abrirEditarOrden(id_btn);
    }

    else if (elmnt_class == 'danger') {
      abrirEliminarOrden(id_btn);
    }
    
  })

  /** Se escuchan los demás botones del Modal Evento */
  btn_nueva_log.addEventListener('click', abrirAgregarLogistica);
  btn_nueva_orden.addEventListener('click', abrirAgregarOrden);

  cerrar.addEventListener('click', () => md_evento.style.display = 'none');
  btn_cancelar.addEventListener('click', () => md_evento.style.display = 'none');
})

function abrirDetalleEvento()
{
  const md_evento = document.querySelector('#MD_evento');

  let id_evento = m_evento.querySelector('#e_id').value,
  data = new FormData();

  data.append('id', id_evento); // Se agrega el id del evento clickeado

  // Muestra los datos en el formulario
  obtenerLogistica(data);
  obtenerOrdenes(data)
  .then(dataJson => {
    let results = dataJson.length;

    if (results <= 0)
    console.log('No hay ordenes', dataJson.length);

    mostrarOrdenes(dataJson);
    md_evento.style.display = 'block'; 
  })

}

/**
 * Funcion para obtener las actividades
 * @param {Object} data 
 */
function obtenerLogistica(data)
{
  fetch('core/ajax/logisticaAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(dataJson => {
    let results = dataJson.length;

    if (results <= 0)
    console.log('No hay logistica', dataJson.length);

    mostrarLogistica(dataJson);
  })
}

/**
 * Funcion para obtener las ordenes de servicio
 * @param {Object} data 
 */
async function obtenerOrdenes(data)
{
  return result = await fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: data
  }).then(response => response.json());
}

/**
 * Funcion que pinta las actividades en la ventana modal
 * @param {object} data 
 */
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

/**
 * Funcion que pinta las ordenes con sus botones
 * @param {Object} data 
 */
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
