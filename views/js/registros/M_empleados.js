((d) => {
    // VARIABLES
    const btn_cerrar = modal_empleados.querySelector('.close'),
    flex_empl = modal_empleados.querySelector('.flex');

    btn_agregar_empleados.addEventListener('click', function() {
        abrirModalEmpl();
    });

    btn_cerrar.addEventListener('click', function() {
        cerrarModalEmpl();
    });

    window.addEventListener('click', function(e) {
        if (e.target == flex_empl) {
            cerrarModalEmpl();
        }
    });

    form_empleado.addEventListener('submit', (e) => {
        e.preventDefault();
    })

    function abrirModalEmpl() {
        modal_empleados.style.display = 'block';
    }

    function cerrarModalEmpl() {
        modal_empleados.style.display = 'none';
    }
})(document);