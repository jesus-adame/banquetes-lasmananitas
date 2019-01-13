addEventListener('DOMContentLoaded', () => {
    // VARIABLES
    const btn_cerrar = modal_empleados.querySelector('.close'),
    flex_empl = modal_empleados.querySelector('.flex');

    btn_agregar_empleados.addEventListener('click', () => {
        modal_empleados.style.display = 'block';
    });

    btn_cerrar.addEventListener('click', () => {
        cerrarModalEmpl();
    });

    window.addEventListener('click', (e) => {
        if (e.target == flex_empl) {
            cerrarModalEmpl();
        }
    });

    form_empleado.addEventListener('submit', (e) => {
        e.preventDefault();
        let data = new FormData(form_empleado);
        console.log(data)
        /*
        solicitarRegistro('core/empleadosAjax.php', 'insertar', data)
        .then(dataJson => {
            if (dataJson == 'success') {
                alert('Se registró correctamente');
            }
        })*/
    })
})

function cerrarModalEmpl() {
    modal_empleados.style.display = 'none';
}