<?php
/* Smarty version 3.1.33, created on 2019-01-04 21:15:33
  from 'C:\xampp\htdocs\banquetes\views\templates\M_sesion.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2fbee5a96505_26021114',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c8231f26e6ed4ca86d5918908732715acc2a4c90' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\M_sesion.tpl',
      1 => 1546632932,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c2fbee5a96505_26021114 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="M_sesion" class="modal">
  <div id="MS_flex" class="flex">
    <div class="modal-content m-sesion col-xs-10 col-sm-7 col-md-5 col-lg-3">
      <div class="modal-header">
        <h3>Iniciar Sesión</h3>
        <a id="MS_cerrar" class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="form_sesion" class="form" action="core/sesionAjaxController.php" method="post">
          Usuario:
          <input class="col-xs-12" type="text" name="usuario" value="">
          Contraseña:
          <input class="col-xs-12" type="password" name="pass" value=""><br><br>

          <button class="btn primary" type="submit" name="button">Ingresar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }
}
