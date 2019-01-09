(function obtenerLugares(select) {
    select.innerHTML = '';

    fetch('core/ajax/obtenerLugares.php', {
        method: 'POST'
    })
    .then(response => response.json())
    .then(dataJson => {
        if (dataJson != 'fail') {
            for (let i in dataJson) {
                let item = dataJson[i];

                select.innerHTML += `<option value="${item.id_lugar}"> ${item.lugar} </option>`;
            }
            
        } else {
            alert('No hay registros');
        }
    })
    .catch(error => {
        consonle.log(`Surgió un error: ${error.message}`);
    })
})(document.getElementById('idlugar'))