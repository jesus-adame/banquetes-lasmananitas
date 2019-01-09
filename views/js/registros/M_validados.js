(() => {
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

    function abrirModalValid() {
        modal_validados.style.display = 'block';
    }

    function cerrarModalValid() {
        modal_validados.style.display = 'none';
    }
})()