class TipoEvento {
    constructor() {
        this.controller = 'tipo_evento'
    }

    async add(formData) {
        formData.append('module', this.controller);
        formData.append('action', 'insertar');

        return this.sendRequest(formData)
    }

    async delete(formData) {
        formData.append('module', this.controller);
        formData.append('action', 'eliminar');

        return this.sendRequest(formData)
    }

    async sendRequest(formData) {
        return fetch('core/Core.php', {
            method: 'post',
            body: formData
        })
        .then(response => response.json())
        .catch(error => {
            popup.alert({ content: error.message })
        })
    }
}