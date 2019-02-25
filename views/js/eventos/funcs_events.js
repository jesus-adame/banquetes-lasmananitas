
function extraerDatosEvento(calEvent) {
  
  e_id.value = calEvent.id_evento;
  e_title.value = calEvent.title;
  e_evento.value = calEvent.evento;
  e_contacto.value = calEvent.contacto;
  e_cord_resp.value = calEvent.cord_resp;
  e_cord_apoyo.value = calEvent.cord_apoyo;
  e_description.innerHTML = calEvent.description;
  e_place.innerHTML = calEvent.lugar;
  idlugar.value = calEvent.id_lugar;
  let select = document.querySelector('#idlugar option:first-child');
  select.value = calEvent.id_lugar;

  fechaHora = calEvent.start._i.split(" ");
  date_start.value = fechaHora[0];
  time.value = fechaHora[1];

  fechaHora_f = calEvent.end._i.split(" ");
  date_end.value = fechaHora_f[0];
  time_f.value = fechaHora_f[1];

  color.value = calEvent.color;
  old_color.value = calEvent.color;
  e_folio.value = calEvent.folio;
  idcategoria.value = calEvent.categoria;
  txtcategoria.innerHTML = calEvent.categoria;
  personas.value = calEvent.personas;
  switch (calEvent.color) {
    case '#d7c735':
    e_status.innerHTML = 'Tentativo';
    break;

    case '#f98710':
    e_status.innerHTML = 'Apartado';
    break;

    case '#e62424':
    e_status.innerHTML = 'Confirmado';
    break;
  }
}

function limpiarDatosEvento(date) {
   e_id.value = '';
   e_title.value = '';
   e_evento.value = '';
   e_contacto.value = '';
   e_cord_resp.value = '';
   e_cord_apoyo.value = '';
   e_description.innerHTML = '';
   e_place.innerHTML = '';
   e_status.innerHTML = '';
   color.value = '#d7c735';
   e_folio.value = '';
   txtcategoria.innerHTML = '';

   date_start.value = date.format('YYYY-MM-DD');
   date_end.value = date.format('YYYY-MM-DD');

   time.value = '00:00:00';
   time_f.value = '23:00:00';

   personas.value = '';
}

function arrastrarEvento(calEvent) {
  e_id.value = calEvent.id_evento;
  e_title.value = calEvent.title;
  e_evento.value = calEvent.evento;
  e_contacto.value = calEvent.contacto;
  e_cord_resp.value = calEvent.cord_resp;
  e_cord_apoyo.value = calEvent.cord_apoyo;
  e_description.innerHTML = calEvent.description
  e_place.innerHTML = calEvent.lugar
  idlugar.value = calEvent.id_lugar;

  fechaHora = calEvent.start.format().split('T')
  date.value = fechaHora[0];
  time.value = fechaHora[1];

  fechaHora_f = calEvent.end.format().split('T')
  date_f.value = fechaHora_f[0];
  time_f.value = fechaHora_f[1];

  categoria.value = calEvent.categoria;
  personas.value = calEvent.personas;

  recolectarDatosGUI()
  enviarInformacion('modificar', nuevoEvento)
}
