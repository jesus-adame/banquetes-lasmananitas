<?php
/* Smarty version 3.1.33, created on 2019-01-05 17:35:43
  from 'C:\xampp\htdocs\banquetes\views\templates\eventos\tab_torna.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c30dcdf102ae4_68136785',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '760fa5ea72300f83e0d7f80d3ca01c6c8eb84e94' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\eventos\\tab_torna.html',
      1 => 1546706093,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c30dcdf102ae4_68136785 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- inputs:
    tipo_formato, nombre, lugar, montaje, garantia, canapes, entrada, fuerte,
    postre, detalle_montaje, ama_llaves, chief_steward, mantenimiento,
    seguridad, recursos_humanos, proveedores, contabilidad
-->
<form id="tab_torna" class="form col-xs-12" action="#" method="post">
    <input class="id_orden" type="hidden" name="id">

    <div class="row-between">
      <div class="col-xs-12 col-md-6">
        <div class="row-between scroll-y" style="padding: 0 20px">
          <input type="hidden" name="tipo_formato" value="torna">

          <div class="col-xs-6">
            Tipo de Ceremonia *:<br>
            <input class="o_nombre col-xs-11" type="text" name="nombre">
          </div>

          <div class="col-xs-6">
            Lugar *: <br>
            <input class="o_place col-xs-12" type="text" name="lugar">
          </div>

          <div class="col-xs-6">
            Montaje *:<br>
            <input class="o_montaje col-xs-11" type="text" name="montaje"><br>
          </div>

          <div class="col-xs-6">
            Garantía *:<br>
            <input class="o_garantia col-xs-12" type="text" name="garantia"><br>
          </div>

          <div class="col-xs-6">
            Nota Especial:<br>
            <textarea wrap="off" class="o_canapes col-xs-11" name="canapes" rows="3"></textarea>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-md-6">
        <div class="row-between scroll-y" style="padding: 0 20px">
          <div class="col-xs-6">
            Detalle montaje:<br>
            <textarea wrap="off" class="o_dmontaje col-xs-11" name="detalle_montaje" rows="3"></textarea>
          </div>

          <div class="col-xs-6">
            Ama de llaves:<br>
            <textarea wrap="off" class="o_ama_llaves col-xs-11" name="ama_llaves" rows="3"></textarea>
          </div>

          <div class="col-xs-6">
            Mantenimiento:<br>
            <textarea wrap="off" class="o_mantenimiento col-xs-11" name="mantenimiento" rows='3'></textarea>
          </div>

          <div class="col-xs-6">
            Seguridad:<br>
            <textarea wrap="off" class="o_seguridad col-xs-11" name="seguridad" rows='3'></textarea>
          </div>

          <div class="col-xs-6">
            Recursos Humanos:<br>
            <textarea wrap="off" class="o_RH col-xs-11" name="recursos_humanos" rows="3"></textarea>
          </div>

          <div class="col-xs-6">
            Proveedores:<br>
            <textarea wrap="off" class="o_proveedores col-xs-11" name="proveedores" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>
    <button form="tab_torna" class="btn success" type="button">Subir</button>
    <button form="tab_torna" class="btn atention" type="button">Editar</button>
  </form><?php }
}
