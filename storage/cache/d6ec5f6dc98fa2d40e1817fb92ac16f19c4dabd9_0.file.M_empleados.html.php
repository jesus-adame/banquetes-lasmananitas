<?php
/* Smarty version 3.1.33, created on 2019-01-08 18:41:46
  from 'C:\xampp\htdocs\banquetes\views\templates\registros\M_empleados.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34e0da416d73_39686044',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd6ec5f6dc98fa2d40e1817fb92ac16f19c4dabd9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\registros\\M_empleados.html',
      1 => 1546969249,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c34e0da416d73_39686044 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="modal_empleados" class="modal">
  <div class="flex">
    <div class="modal-content col-xs-10 col-sm-7 col-md-4">
      <div class="modal-header">
        <h3>Personal</h3>
        <a class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="form_empleado" class="form col-xs-12" action="#" method="post">
            Nombre:<br>
            <input type="text" class="col-xs-12" name="nombre"><br>
            Apellido:<br>
            <input type="text" class="col-xs-12" name="apellido"><br>
            Departamento:<br>
            <input type="text" class="col-xs-12" name="depto"><br>
            Cargo:<br>
            <input type="text" class="col-xs-12" name="cargo"><br>
            Correo:<br>
            <input type="email" class="col-xs-12" name="email"><br><br>

            <button type="submit" class="btn success">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div><?php }
}
