<?php
/* Smarty version 3.1.33, created on 2019-01-09 16:52:25
  from 'C:\xampp\htdocs\banquetes\views\templates\eventos\form_eliminar_orden.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c3618b9d22924_08910638',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd3e2de83a2580313715fd4449abb460976165a01' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\eventos\\form_eliminar_orden.html',
      1 => 1546992732,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c3618b9d22924_08910638 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="frm_eliminar_orden" class="sub-modal">
    <div class="flex">
        <div class="modal-content col-xs-8 col-sm-4 col-lg-3">
            <div class="modal-header">
                <h3>Borrar</h3>
            </div>
            <div class="modal-body">
                <h3>¿Está seguro/a?</h3><br>
                <form class="form col-xs-12" action="#" method="post">
                <input type="hidden" name="id" value=""> 
                <div class="row-between">
                    <button class="btn danger" type="submit">Eliminar</button>
                    <button id="cerrar" class="btn default" type="button">Cancelar</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div><?php }
}
