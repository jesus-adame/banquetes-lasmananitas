<?php
/* Smarty version 3.1.33, created on 2019-01-05 02:52:53
  from 'C:\xampp\htdocs\banquetes\views\templates\calendario\MD_evento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c300df5cdcde1_00354822',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'da90dfcf7d5773d732cdcdfb73b3c1b16e22dc27' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\calendario\\MD_evento.tpl',
      1 => 1546653172,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c300df5cdcde1_00354822 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="MD_evento" class="sub-modal">
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
<?php }
}
