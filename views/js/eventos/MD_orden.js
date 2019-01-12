/**
 * Eschucha los eventos de los botones Editar/Agregar
 * Evita errores
 */
(() => {
  const btns_agregar = md_orden.querySelectorAll('.success'),
  btns_editar = md_orden.querySelectorAll('.atention'),
  forms = md_orden.querySelectorAll('form'),
  fondo = md_orden.querySelector('.flex'),
  cerrar = md_orden.querySelector('.close');

  btns_editar.forEach(item => {
    item.addEventListener('click', (e) => {
      enviarFormulario(e.target, forms, editOrden)
    });
  });

  btns_agregar.forEach(item => {
    item.addEventListener('click', (e) => {
      enviarFormulario(e.target, forms, addOrden)
    });
  });

  let enviarFormulario = (btn, frms, callback) => {
    let form_id = btn.getAttribute('form');
    form = md_orden.querySelector('#' + form_id);
    callback(form, frms);
  }

  /** Se cierra el formulario */
  window.addEventListener('click', (e) => {
    if (e.target == fondo || e.target == cerrar) {
      borrarCamposExtra();
      forms.forEach(item => item.reset());      
      md_orden.style.display = 'none';
    }
  });

  /** Formulario Borrar */
  const modal_borrar = document.querySelector('#frm_eliminar_orden'),
  fondo_borrar = modal_borrar.querySelector('.flex'),
  frm_borrar = modal_borrar.querySelector('form'),
  cerrar_borrar = modal_borrar.querySelector('#cerrar');

  window.addEventListener('click', (e) => {
    if (e.target == fondo_borrar || e.target == cerrar_borrar) {
      modal_borrar.style.display = 'none';
      frm_borrar.reset();
    }
  });

  frm_borrar.addEventListener('submit', e => {
    e.preventDefault();
    borrarOrden(frm_borrar, modal_borrar);
  })

})();

function abrirEditarOrden(id) {
  const md_orden = document.querySelector('#md_orden'),
  btns_agregar = md_orden.querySelectorAll('.success'),
  btns_editar = md_orden.querySelectorAll('.atention'),
  btns_mas = md_orden.querySelectorAll('.primary');
  
  for (let i = 0; i < btns_agregar.length; i++) {
    btns_agregar[i].style.display = 'none';
    btns_editar[i].style.display = 'block';
    btns_mas[i].style.display = 'none';
  }

  obtenerDatosOrden(id);
}

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

/**
 * Funciones CRUD
*/

function addOrden(frm, forms) {
  let fecha = document.querySelector('#date_start'),
  time = document.querySelector('#time'),
  formData = new FormData(frm);

  formData.append('accion', 'agregar');
  formData.append('id_evento', id_evento.value);
  formData.append('fecha', fecha.value);
  formData.append('time', time.value);

  result = fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(dataJson => {

    if (dataJson == 'success') {

      let ord = new FormData();
      ord.append('id', id_evento.value);
      obtenerOrdenes(ord)
      .then(dataJson => {
        let results = dataJson.length;
    
        if (results <= 0)
        console.log('No hay ordenes', dataJson.length);
    
        mostrarOrdenes(dataJson);
        md_orden.style.display = 'none';
      })
      
      borrarCamposExtra();
      forms.forEach(item => item.reset());

    } else if (dataJson == 'empty_fields') {
      alert('Debe llenar los campos obligatorios (*)');
      
    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de editar este usuario');
    }
  })
}

function editOrden(frm, forms) {
  const md_orden = document.querySelector('#md_orden');
  let fecha = document.querySelector('#date_start'),
  time = document.querySelector('#time'),
  formData = new FormData(frm);

  formData.append('accion', 'modificar');
  formData.append('id_evento', id_evento.value);
  formData.append('fecha', fecha.value);
  formData.append('time', time.value);

  fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(dataJson => {

    if (dataJson == 'success') {
      let ord = new FormData();
      ord.append('id', id_evento.value)

      obtenerOrdenes(ord)
      .then(dataJson => {
        let results = dataJson.length;
    
        if (results <= 0)
        console.log('No hay ordenes', dataJson.length);
    
        mostrarOrdenes(dataJson); 
      })
      md_orden.style.display = 'none';
      borrarCamposExtra();
      forms.forEach(item => item.reset());

    } else if (dataJson == 'empty_fields') {
      alert('Debe llenar los campos obligatorios (*)');
      
    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de editar este evento');
    }
  });
}

function borrarOrden(form_orden, modal) {
  let Datos = new FormData(form_orden);
  
  Datos.append('id_evento', id_evento.value);
  Datos.append('accion', 'eliminar');

  fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: Datos
  })
  .then(response => response.json())
  .then(dataJson => {
    
    if (dataJson == 'success') {
      
      let ord = new FormData();
      ord.append('id', id_evento.value);
      obtenerOrdenes(ord)
      .then(dataJson => {
        let results = dataJson.length;
    
        if (results <= 0)
        console.log('No hay ordenes', dataJson.length);
    
        mostrarOrdenes(dataJson);
      })
      modal.style.display = 'none';
      
    } else if (dataJson == 'not_user') {
      alert('No tiene permiso de modificar este evento');
    }
  })
}

function obtenerDatosOrden(id) {
  let mdl = document.querySelector('#md_orden'),
  tabs = mdl.querySelectorAll('.tab');

  data = new FormData();
  
  data.append('id', id);
  data.append('accion', 'obtener');

  fetch('core/ajax/ordenesAjaxController.php', {
    method: 'POST',
    body: data
  })
  .then(response => response.json())
  .then(dataJson => {
    let id_orden = mdl.querySelectorAll('.id_orden');    
    evento = mdl.querySelectorAll('.o_nombre'),
    place = mdl.querySelectorAll('.o_place'),
    montaje = mdl.querySelectorAll('.o_montaje'),
    garantia = mdl.querySelectorAll('.o_garantia'),
    canapes = mdl.querySelectorAll('.o_canapes'),
    entrada = mdl.querySelectorAll('.o_entrada'),
    fuerte = mdl.querySelectorAll('.o_fuerte'),
    postre = mdl.querySelectorAll('.o_postre'),
    bebidas = mdl.querySelectorAll('.o_bebidas'),
    cocteleria = mdl.querySelectorAll('.o_cocteleria'),
    mezcladores = mdl.querySelectorAll('.o_mezcladores'),
    dmontaje = mdl.querySelectorAll('.o_dmontaje'),
    ama_llaves = mdl.querySelectorAll('.o_ama_llaves'),
    chief_steward = mdl.querySelectorAll('.o_chief_steward'),
    mantenimiento = mdl.querySelectorAll('.o_mantenimiento'),
    seguridad = mdl.querySelectorAll('.o_seguridad'),
    RH = mdl.querySelectorAll('.o_RH'),
    proveedores = mdl.querySelectorAll('.o_proveedores'),
    contabilidad = mdl.querySelectorAll('.o_contabilidad'),
    formularios = mdl.querySelectorAll('form'),
    observaciones = mdl.querySelectorAll('.o_observaciones');

    for (let i in dataJson) {
      let val = dataJson[i],
      num_inputs = evento.length;

      /** Da click a la pestaña con el mismo formato */
      tabs.forEach(tab => {
        if (tab.innerHTML.toLowerCase() === val.tipo_formato)
        tab.click()
      });
      
      tabs.forEach(tab => {
        tab.style.pointerEvents = 'none';
        tab.style.color = '#5f5f5f';
      });

      for (let j = 0; j < num_inputs; j++) {
        id_orden[j].value = val.id_orden;
        evento[j].value = val.orden;
        place[j].value = val.lugar;
        montaje[j].value = val.montaje;
        garantia[j].value = val.garantia;
        dmontaje[j].value = val.detalle_montaje;
        ama_llaves[j].value = val.ama_llaves;
        mantenimiento[j].value = val.mantenimiento;
      }

      switch (val.tipo_formato) {
        case 'ceremonia': 
          observaciones[1].value = val.observaciones;         
          seguridad[0].value = val.seguridad;
          RH[0].value = val.recursos_humanos;
          proveedores[0].value = val.proveedores;

          getCamposExtra().then(res => { 
            nc_ceremonia = pintarCampos(res, campos_ceremonia, nc_ceremonia); md_orden.style.display = 'block';
          });
        break;

        case 'grupo':
          canapes[0].value = val.canapes;
          observaciones[0].value = val.observaciones;         
          contabilidad[0].value = val.contabilidad;
          chief_steward[0].value = val.chief_steward;

          getCamposExtra().then(res => {
            nc_grupo = pintarCampos(res, campos_grupo, nc_grupo); md_orden.style.display = 'block';
          });
        break;

        case 'coctel':
          canapes[1].value = val.canapes;
          cocteleria[0].value = val.cocteleria;
          seguridad[1].value = val.seguridad;
          RH[1].value = val.recursos_humanos;
          proveedores[1].value = val.proveedores;
          contabilidad[1].value = val.contabilidad;
          chief_steward[1].value = val.chief_steward;
          cocteleria[0].value = val.cocteleria;
          bebidas[0].value = val.bebidas;
          mezcladores[0].value = val.mezcladores;

          getCamposExtra().then(res => {
            nc_coctel = pintarCampos(res, campos_coctel, nc_coctel); md_orden.style.display = 'block';
          });
        break;

        case 'banquete':

          entrada[0].value = val.entrada;
          fuerte[0].value = val.fuerte;
          postre[0].value = val.postre;
          seguridad[2].value = val.seguridad;
          RH[2].value = val.recursos_humanos;
          proveedores[2].value = val.proveedores;
          contabilidad[2].value = val.contabilidad;
          chief_steward[2].value = val.chief_steward;
          bebidas[0].value = val.bebidas;
          mezcladores[0].value = val.mezcladores;
          observaciones[2].value = val.observaciones;          

          getCamposExtra().then(res => {
            nc_banquete = pintarCampos(res, campos_banquete, nc_banquete); md_orden.style.display = 'block';
          });
        break;
      }
    }
    
  });

  async function getCamposExtra() {
    let d = new FormData(); d.append('id_orden', id);
  
    return res = await fetch('core/ajax/camposOrdenes.php', {
      method: 'POST',
      body: d
    }).then(response => response.json())
    .then(dataJson => dataJson);
  }

  function pintarCampos(arrayJson, camposContainer, numeroCampos) {
    
    if (arrayJson != 'no_data') {
      
      arrayJson.forEach(item => {
        if (numeroCampos < 5) {
          const e = document.createElement('div');
          e.className = 'col-xs-6';
          e.innerHTML = `<input type="hidden" name="id_campo[]" value="${item.id_campo}">
          <input class="o_tag col-xs-7" type="text" name="tag[]" value="${item.tag}"> <br>
          <textarea wrap="off" class="o_content col-xs-11" name="content[]" rows="3">${item.content}</textarea>`;
          
          camposContainer.appendChild(e);
          numeroCampos++;
          
        } else { alert('Se ha alcanzado el máximo de campos disponibles'); }
      })
    }
    return numeroCampos;
  }
}

function borrarCamposExtra() {
  if (nc_grupo) {
    for (nc_grupo; nc_grupo > 0; nc_grupo--) {
      campos_grupo.lastChild.remove();
    }
  }

  if (nc_banquete) {
    for (nc_banquete; nc_banquete > 0; nc_banquete--) {
      campos_banquete.lastChild.remove();
    }
  }

  if (nc_ceremonia) {
    for (nc_ceremonia; nc_ceremonia > 0; nc_ceremonia--) {
      campos_ceremonia.lastChild.remove();
    }
  }

  if (nc_coctel) {
    for (nc_coctel; nc_coctel > 0; nc_coctel--) {
      campos_coctel.lastChild.remove();
    }
  }
}