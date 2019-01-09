<?php
/* Smarty version 3.1.33, created on 2018-12-29 16:43:51
  from 'C:\xampp\htdocs\banquetes\views\templates\calendario\MD_logistica.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c279637d88cb8_09244156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '376344997cf408ecce55c90fda2f80e4e9b5a0ba' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\calendario\\MD_logistica.tpl',
      1 => 1543387941,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c279637d88cb8_09244156 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="md_logistica" class="sub-modal">
  <div id="mdl_flex" class="flex">
    <div class="modal-content col-xs-5">
      <div class="modal-header">
        <h3>Cabezera</h3>
        <a id="mdl_cerrar" class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="fd_logistica" class="form col-xs-12" action="#" method="post">
          <div class="col-xs-12">
            Inicio:<br>
            <input class="col-xs-12" type="text" name="inicio" value="" required>
            Final:<br>
            <input class="col-xs-12" type="text" name="final" value="" required>
            Actividad:<br>
            <input class="col-xs-12" type="text" name="actividad" value="">
            Lugar:
            <input class="col-xs-12" type="text" name="lugar" value="">
          </div><br>
          <button onclick="addLogistica()" class="btn success" type="button" name="button">Subir</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php }
}
