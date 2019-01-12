<div id="M_evento" class="modal">
  <div id="flex" class="flex">
    <div class="modal-content col-xs-11 col-md-9">
      <div class="modal-header">
        <h3>Evento</h3>
        <ul class="tabs">
          <li>
            <button id="btnDetalleEvento" class="btn primary" type="button">Detalles</button>
          </li>
        </ul>
      </div>
      <div class="modal-body">
        <form id="form_evento" class="form col-xs-12" action="#" method="post">
          <input id="e_id" type="hidden" name="id">

          <div class="row-between">
            <div class="col-xs-12 col-sm-5">
              Titulo:
              <span class="etiqueta col-xs-12" id="e_title"></span><br>

              Evento:
              <span class="etiqueta col-xs-12" id="e_evento"></span><br>

              Personas:
              <span class="etiqueta col-xs-12" id="e_personas"></span><br><br>
              
              <div class="row-between">
                <div class="col-xs-6">
                  Fecha inicio:
                  <span class="etiqueta col-xs-11" id="date"></span><br>
                      
                  Hora inicio:
                  <span class="etiqueta col-xs-11" id="time"></span>
                </div>

                <div class="col-xs-6">
                  Fecha final:
                  <span class="etiqueta col-xs-12" id="date_f"></span><br>
                  
                  Hora final:
                  <span class="etiqueta col-xs-12" id="time_f"></span>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6">
              Contacto:
              <span class="etiqueta col-xs-12" id="e_contacto"></span><br>
              
              Cord. Responsable:
              <span class="etiqueta col-xs-12" id="e_cord_resp"></span><br>

              Cord. Apoyo:
              <span class="etiqueta col-xs-12" id="e_cord_apoyo"></span><br>

              Descripción:
              <span class="etiqueta col-xs-12" id="e_description"></span><br><br>

              <div class="row-between">
                <div class="col-xs-6">
                  Salón / Lugar: 
                  <span class="etiqueta col-xs-11" id="e_place"></span>
                </div><br>

                <div class="col-xs-6">
                  Categoria:
                  <span class="etiqueta col-xs-12" id="txtcategoria"></span>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="modal-footer">
          <button id="cerrar" class="btn default" type="button">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
