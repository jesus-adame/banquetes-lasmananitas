<?php
/* Smarty version 3.1.33, created on 2019-01-05 02:56:29
  from 'C:\xampp\htdocs\banquetes\views\templates\MD_evento.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c300ecdee60e3_71250616',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '17509b18acddf351e3a1a3cde52d19eedb9a75a8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\MD_evento.tpl',
      1 => 1546653389,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c300ecdee60e3_71250616 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="MD_evento" class="sub-modal">
  <div class="flex">
    <div class="modal-content col-xs-11 col-md-10">
      <div class="modal-header">
        <h3>Información del evento</h3>
        <a class="close">&times;</a>
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
                <th>Opciones</th>
              </tr>
            </thead>
            <tbody id="tb_logistica">
                          </tbody>
          </table>
          </div>
          <button id="btnAgregarLogistica" class="btn primary" type="button">Agregar</button>
        </div>

        <div class="col-xs-11 col-md-6  m-auto-x">
          <h3>Ordenes de servicio</h3>

          <div class="t-scroll-y">
            <table class="table">
              <thead>
                <tr>
                  <th># Id</th>
                  <th>Fecha</th>
                  <th>Nombre</th>
                  <th>Lugar</th>
                  <th>Opciones</th>
                </tr>
              </thead>
              <tbody id="tbody_orden">
                              </tbody>
            </table>
          </div>
          <button id="btn_agregar_orden" class="btn primary" type="button">Agregar</button>
        </div>

        <div class="modal-footer">
          <button id="cancelar" class="btn default" type="button">Cancel</button>
        </div>
      </div>      
    </div>
  </div>
</div>
<?php }
}
