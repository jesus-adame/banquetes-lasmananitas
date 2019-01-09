<?php
/* Smarty version 3.1.33, created on 2019-01-08 18:22:49
  from 'C:\xampp\htdocs\banquetes\views\templates\registros\M_usuarios.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34dc69a41047_96307436',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9a6751b427f522721b0568fbd784f4d865d32aca' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\registros\\M_usuarios.html',
      1 => 1546968160,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c34dc69a41047_96307436 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="modal_usuarios" class="modal">
  <div class="flex">
    <div class="modal-content col-xs-10 col-sm-7 col-md-4">
      <div class="modal-header">
        <h3>Personal</h3>
        <a class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="form_usuario" class="form col-xs-12" action="core/ajax/registrosAjaxController.php" method="post">
            Nombre de usuario:<br>
            <input type="text" class="col-xs-12" name="usuario"><br>
            Contraseña:<br>
            <input type="password" class="col-xs-12" name="pass"><br>
            Repetir contraseña:<br>
            <input type="password" class="col-xs-12" name="pass2"><br><br>

            <button type="submit" class="btn success">Registrar</button>
        </form>
      </div>
    </div>
  </div>
</div><?php }
}
