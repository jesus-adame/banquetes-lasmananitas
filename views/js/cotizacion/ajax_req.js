async function peticionAjax(url, accion, formData, tabla = '') {
    openLoading();
    formData.append('action', accion);
    formData.append('tabla', tabla);

    return await fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => {
        closeLoading();
        return response.json();
    }).catch(error => {
        closeLoading();
        popup.alert({ content: error.message });
    })
}