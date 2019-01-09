<?php
/* Smarty version 3.1.33, created on 2018-12-31 06:37:42
  from 'C:\xampp\htdocs\banquetes\views\templates\eventos\form_eliminar_log.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c29ab267c6d24_53027698',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42afd4381eb3a08b5dd17db2924c1d564af330eb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\eventos\\form_eliminar_log.html',
      1 => 1546234653,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c29ab267c6d24_53027698 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="f_eliminar_log" class="sub-modal">
    <div class="flex">
        <div class="modal-content col-xs-8 col-sm-4 col-lg-3">
            <div class="modal-header">
                <h3>Borrar</h3>
            </div>
            <div class="modal-body">
                <h4>¿Está seguro/a?</h4><br>
                <form id="form_eliminar_logistica" class="form col-xs-12" action="core/ajax/logisticaAjaxController.php" method="post">
                <input id="id_elim_log" type="hidden" name="id" value=""> 
                <div class="row-between">
                    <button onclick="eliminarLogistica()" class="btn danger" type="button">Eliminar</button>
                    <button class="cerrar btn default" type="button">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div><?php }
}
