<?php
/* Smarty version 3.1.33, created on 2019-01-08 19:31:03
  from 'C:\xampp\htdocs\banquetes\views\templates\registros\M_validados.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34ec67ef2c73_12234886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '721e66a601337c860c1a060e34490db84394b12c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\registros\\M_validados.html',
      1 => 1546972231,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c34ec67ef2c73_12234886 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="modal_validados" class="modal">
  <div class="flex">
    <div class="modal-content col-xs-10 col-sm-7 col-md-4">
      <div class="modal-header">
        <h3>Personal</h3>
        <a class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="form_validado" class="form col-xs-12" action="#" method="post">
            Usuario:<br>
            <select name="id_usuario" class="col-xs-12">
              <option value="">Opcion</option>
              <option value="">Opcion</option>
              <option value="">Opcion</option>
            </select><br>

            Personal:<br>
            <select name="id_empleado" class="col-xs-12">
              <option value="">Opcion</option>
              <option value="">Opcion</option>
              <option value="">Opcion</option>
            </select><br>

            Rol:<br>
            <select name="rol" class="col-xs-12">
              <option value="">Opcion</option>
              <option value="">Opcion</option>
              <option value="">Opcion</option>
            </select>
            <br><br>

            <button type="submit" class="btn success">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div><?php }
}
