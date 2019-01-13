addEventListener('DOMContentLoaded', () => {
    // VARIABLES
    const btn_cerrar = modal_validados.querySelector('.close'),
    fondo = modal_validados.querySelector('.flex');

    btn_agregar_validados.addEventListener('click', function() {
        abrirModalValid();
    });

    btn_cerrar.addEventListener('click', function() {
        cerrarModalValid();
    });

    window.addEventListener('click', function(e) {
        if (e.target == fondo) {
            cerrarModalValid();
        }
    });

    form_validado.addEventListener('submit', (e) => {
        e.preventDefault();
    })
})

async function abrirModalValid() {
    await obtenerDatos('usuarios')
    .then(dataJson => {
        for (let i in dataJson) {
           let item = dataJson[i]; 
           select_usuario.innerHTML += `<option value="${item.id_usuario}">${item.nombre_usuario}</option>`;
        }
    })
    await obtenerDatos('roles')
    .then(dataJson => {
        for (let i in dataJson) {
           let item = dataJson[i]; 
           select_roles.innerHTML += `<option value="${item.nombre}">${item.nombre}</option>`;
        }
    })
    await obtenerDatos('empleados')
    .then(dataJson => {
        for (let i in dataJson) {
           let item = dataJson[i]; 
           select_personal.innerHTML += `<option value="${item.id_personal}">${item.nombre} ${item.apellido}</option>`;
        }
    }).then(() => modal_validados.style.display = 'block');    
}

function cerrarModalValid() {
    modal_validados.style.display = 'none';
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