((d) => {
    // VARIABLES
    const btn_cerrar = modal_usuarios.querySelector('.close'),
    flex_usu = modal_usuarios.querySelector('.flex');

    btn_agregar_usuarios.addEventListener('click', function() {
        abrirModalUsu();
    });

    btn_cerrar.addEventListener('click', function() {
        cerrarModalUsu();
    });

    window.addEventListener('click', function(e) {
        if (e.target == flex_usu) {
            cerrarModalUsu();
        }
    });

    function cerrarModalUsu() {
        modal_usuarios.style.display = 'none';
    }

    form_usuario.addEventListener('submit', (e) => {
        e.preventDefault();
        let formdata = new FormData(form_usuario);

        res = solicitarRegistro('core/ajax/registrosAjaxController.php', 'agregar', formdata)
        .then(dataJson => {
            if (dataJson == 'empty_fields') {
                alert('Debes llenar todos los campos');
            } else if (dataJson == 'pass_dont_match') {
                alert('Las contraseñas no coinciden');
            } else if (dataJson == 'dont_length') {
                alert('Las contraseñas deben ser de almenos 6 caracteres');
            } else if (dataJson == 'success') {
                alert('Se ha creado el usuario');
                location.reload();
                cerrarModalUsu();
            }
        });
    })
})(document);

function abrirModalUsu() {
    modal_usuarios.style.display = 'block';        
}