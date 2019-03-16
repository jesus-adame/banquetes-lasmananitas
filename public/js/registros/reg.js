class Modal {
    constructor(id_modal) {
        this.modal = id_modal;
        this.fondo = this.modal.querySelector('.flex');
        this.btn_close = this.modal.querySelector('.close');
    }
}

async function peticionAjax(url, accion, formData) {
    formData.append('action', accion);

    return result = await fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()).catch(error => {
        console.log('Hubo un error ', error.message);
    })
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

function obtenerDatosDonde(tabla, campo, valor) {
    let data = new FormData();
    data.append('tabla', tabla);
    data.append('campo', campo);
    data.append('valor', valor);

    return res = fetch('core/ajax/verRegistro.php', {
        method: 'POST',
        body: data
    })
    .then(response => response.json())
}

addEventListener('DOMContentLoaded', () => {
    // VARIABLES
    const modalUsu = new Modal(modal_usuarios);
    tabla_usu = new FormData();

    btn_add_usuarios.addEventListener('click', (e) => {
        modal_usuarios.style.display = 'block';
        btn_reg.style.display = 'block';
        btn_act.style.display = 'none';
        form_usuario.querySelector('.div-pass').style.display = 'block';
    });
    
    window.addEventListener('click', (e) => {
        if (e.target == modalUsu.fondo || e.target == modalUsu.btn_close) {
            form_usuario.reset();
            modal_usuarios.style.display = 'none';
        }
    });

    form_usuario.addEventListener('submit', (e) => {
        e.preventDefault();
        let formdata = new FormData(form_usuario);

        res = peticionAjax('core/ajax/registrosAjaxController.php', 'agregar', formdata)
        .then(dataJson => {
            if (dataJson == 'empty_fields') {
                popup.alert({ content: 'Debes llenar todos los campos' });
            } else if (dataJson == 'pass_dont_match') {
                popup.alert({ content: 'Las contraseñas no coinciden' });
            } else if (dataJson == 'dont_length') {
                popup.alert({ content: 'Las contraseñas deben ser de almenos 6 caracteres' });
            } else if (dataJson == 'error') {
                popup.alert({ content: 'Ya hay un registro con ese nombre de usuario' });
            } else if (dataJson == 'success') {
                popup.alert({ content: 'Se ha creado el usuario' });
                form_usuario.reset();
                location.reload();
                modal_usuarios.style.display = 'none';
            }
        });
    })

    tbody_usuarios.addEventListener('click', (e) => {
        const btn = e.target.className,
        id = e.target.parentElement.parentElement.parentElement.firstElementChild.textContent;
    
        if (btn == 'btn atention') {
            btn_reg.style.display = 'none';
            btn_act.style.display = 'block';
            
            obtenerDatosDonde('usuarios', 'id_usuario', id)
            .then(dataJson => {
                let item = dataJson[0],
                m_input = form_usuario.querySelectorAll('input'),
                select = form_usuario.querySelectorAll('select');
                // Se cargan los datos al formulario
                m_input[0].value = item.id_usuario;
                m_input[1].value = item.username;
                select[0].firstElementChild.value = item.nivel;
                select[1].firstElementChild.value = item.estado;
                form_usuario.querySelector('.div-pass').style.display = 'none';
                modal_usuarios.style.display = 'block';
            })

        } else if (btn == 'btn danger') {
            popup.confirm({
               content: '<b>Eliminar</b><br><br>¿Está seguro?',
               default_btns: {
                  ok: 'SÍ',
                  cancel: 'NO'
               }
            },
            (clk) => {
                if (clk.proceed) {
                    let formdata = new FormData();
                    formdata.append('id', id);
        
                    resPromise = peticionAjax('core/ajax/registrosAjaxController.php', 'borrar', formdata)
                    .then(dataJson => {
                        if (dataJson == 'error') {
                            popup.alert({ content: 'No se pudo borrar el usuario' })
                        } else if (dataJson == 'success') {
                            location.reload();
                        }
                    })
                }
            });
        }
    })

    btn_act.addEventListener('click', e => {
        popup.confirm({
            content: 'Confirmar cambios', effect: 'bottom'
        },
        (clck) => {
            if (clck.proceed) {
                let formdata = new FormData(form_usuario);

                res = peticionAjax('core/ajax/registrosAjaxController.php', 'editar', formdata)
                .then(dataJson => {
                    if (dataJson == 'success') {
                        location.reload();
                        form_usuario.reset();
                    } else {
                        alert('No se pudo editar el usuario');
                    }
                })
            }
        })        
    })
})