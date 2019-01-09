async function solicitarRegistro(url, accion, formData) {
    formData.append('action', accion);

    return result = await fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()).catch(error => {
        console.log('Hubo un error ', error.message);
    })
}