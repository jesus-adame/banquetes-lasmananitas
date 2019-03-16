class Modal {
    constructor(id_modal) {
        this.modal = id_modal;
        this.fondo = this.modal.querySelector('.flex');
        this.btn_close = this.modal.querySelector('.close');
    }
}