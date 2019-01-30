addEventListener('DOMContentLoaded', () => {
    form_cotizacion.querySelectorAll('input')[0].focus();

    peticionAjax('core/ajax/obtenerLugares.php', 'obtener', new FormData())
    .then(dataJson => {
        select_lugar.innerHTML = '';

        for (let i in dataJson) {
            let val = dataJson[i];

            select_lugar.innerHTML += `<option value="${val.id_lugar}">${val.lugar}</option>`;
        }
    })

    document.addEventListener('submit', (e) => {
        e.preventDefault();
        let userData = new FormData(e.target);

        if (userData.get('cliente') != null && userData.get('telefono') != null
        && userData.get('email') != null && userData.get('pax') != null) {
            if (userData.get('fecha_inicio') < userData.get('fecha_final')) {
                peticionAjax('core/ajax/cotizacion.php', 'comprobar', userData)
                .then(dataJson => {
                    if (dataJson === 'empty_fields') {
                        popup.alert({ content: 'Debe llenar todos los campos' });
                    /*} else if (dataJson === 'El salon esta libre en esa fecha') {
                        popup.confirm({ content: dataJson },
                        (clck) => {
                            if (clck.proceed) {
                                location.assign('')
                            }
                        });*/
                    } else {
                        console.log(dataJson)
                        popup.alert({ content: dataJson });
                    }
                })
            } else {
                popup.alert({ content: 'La fecha final debe ser posterior a la fecha de inicio' });
            }
        } else { popup.alert({ content: 'Debe llenar todos los campos' }); }       
        
    })
})