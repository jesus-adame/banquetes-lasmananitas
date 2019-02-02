addEventListener('DOMContentLoaded', () => {
    form_cotizacion.querySelectorAll('input')[0].focus();

    peticionAjax('core/ajax/obtenerLugares.php', 'obtener', new FormData())
    .then(dataJson => {
        select_lugar.innerHTML = '<option value="0">- Elegir -</option>';

        for (let i in dataJson) {
            let val = dataJson[i];

            select_lugar.innerHTML += `<option value="${val.id_lugar}">${val.lugar}</option>`;
        }
    })
    
    peticionAjax('core/ajax/obtenerDatos.php', 'obtener', new FormData(), 'tipo_eventos')
    .then(dataJson => {
        select_evento.innerHTML = '<option value="7">- Elegir -</option>';

        for (let i in dataJson) {
            let val = dataJson[i];

            select_evento.innerHTML += `<option value="${val.id_tipo_evento}">${val.nombre_tevento}</option>`;
        }
    })
    

    document.addEventListener('submit', (e) => {
        e.preventDefault();
        e.stopPropagation();
        
        let userData = new FormData(e.target);

        if (userData.get('cliente') != null && userData.get('telefono') != null
        && userData.get('email') != null && userData.get('pax') != null) {
            if (d_init.value + ' ' + t_init.value < d_end.value + ' ' + t_end.value) {
                peticionAjax('core/ajax/cotizacion.php', 'comprobar', userData)
                .then(dataJson => {
                    if (dataJson === 'empty_fields') {
                        popup.alert({ content: 'Debe llenar todos los campos' });                    
                    } else {
                        popup.alert({ content: dataJson });
                    }
                })
            } else {
                popup.alert({ content: 'La fecha final debe ser posterior a la fecha de inicio' });
            }
        } else { popup.alert({ content: 'Debe llenar todos los campos' }); }
    })

    cot_ajustes.addEventListener('click', e => {
        e.preventDefault();
    })
})