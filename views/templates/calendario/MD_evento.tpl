<div id="MD_evento" class="sub-modal">
  <div id="DE_flex" class="flex">
    <div class="modal-content col-xs-11 col-md-10">
      <div class="modal-header">
        <h3>Información del evento</h3>
        <a id="mde_cerrar" class="close">&times;</a>
      </div>
      <div class="modal-body row-between">
        <div class="col-xs-11 col-md-6 m-auto-x">
          <h3>Logística</h3>

          <div class="t-scroll-y" style="margin-right: 10px">
            <table class="table">
              <thead>
                <tr>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Actividad</th>
                  <th>Lugar</th>
                </tr>
              </thead>
              <tbody id="tb_logistica">
                {* <tr>
                  <td>fecha</td>
                  <td>Hora</td>
                  <td>Actividad</td>
                  <td>Lugar</td>
                </tr> *}
              </tbody>
            </table>
          </div>
        </div>

        <div class="col-xs-11 col-md-6 m-auto-x">
          <h3>Ordenes de servicio</h3>

          <div class="t-scroll-y">
            <table class="table">
              <thead>
                <tr>
                  <th># Id</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Lugar</th>
                  <th>Imprimir</th>
                </tr>
              </thead>
              <tbody id="tbody_orden">
              <!--- Codigo Javascript
                <tr>
                  <td>2</td>
                  <td>23/11/2018</td>
                  <td>Prueba2</td>
                  <td>Casa</td>
                  <td>
                    <a class="btn atention" href="#"><i class="fas fa-print"></i></a>
                  </td>
                </tr>
               --->
              </tbody>
            </table>
          </div>
        </div>

        <div class="modal-footer">
          <button onclick="cancelarDetalleEvento()" class="btn default" type="button">Cancel</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
