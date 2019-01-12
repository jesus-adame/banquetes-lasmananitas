addEventListener('DOMContentLoaded', () => {
    // VARIABLES
    const btn_cerrar = modal_empleados.querySelector('.close'),
    flex_empl = modal_empleados.querySelector('.flex');

    btn_agregar_empleados.addEventListener('click', () => {
        abrirModalEmpl();
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
    })
})

function abrirModalEmpl() {
    modal_empleados.style.display = 'block';
}

function cerrarModalEmpl() {
    modal_empleados.style.display = 'none';
}