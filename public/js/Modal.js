class Modal {
   constructor(id_modal) {
      this.modal = id_modal;
      this.titulo = this.modal.querySelector('.title');
      this.fondo = this.modal.querySelector('.flex');
      this.btn_close = this.modal.querySelector('.close');
   }

   abrir() {
      this.modal.style.display = 'block';
   }

   cerrar() {
      this.modal.style.display = 'none';
   }
}