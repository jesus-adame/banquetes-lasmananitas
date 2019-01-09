(() => {
    tbody_usuarios.addEventListener('click', (e) => {
        const btn = e.target.className,
        id = e.target.parentElement.parentElement.firstElementChild.textContent;

        if (btn == 'btn atention') {
            abrirModalUsu()
            console.log('Editar', id)
        } else if (btn == 'btn danger') {
            res = confirm('¿Eliminar usuario ' + id + '?')

            if (res == true) {
                let formdata = new FormData();
                formdata.append('id', id);

                resPromise = solicitarRegistro('core/ajax/registrosAjaxController.php', 'borrar', formdata)
                .then(dataJson => {
                    console.log(dataJson)
                    if (dataJson == 'error') {
                        alert('No se pudo borrar el usuario')
                    } else if (dataJson == 'success') {
                        location.reload()
                    }
                })
            }
        }
    })
})()