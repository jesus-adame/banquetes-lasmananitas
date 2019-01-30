async function peticionAjax(url, accion, formData) {
    formData.append('action', accion);

    return await fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()).catch(error => {
        popup.alert({ content: error.message });
    })
}