<?php
/* Smarty version 3.1.33, created on 2019-01-08 00:43:52
  from 'C:\xampp\htdocs\banquetes\views\templates\eventos\tab_ceremonia.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c33e4388a93f2_58393313',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'bd85c89f6c4bacc6721abdcb5b22de820d003d0a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\eventos\\tab_ceremonia.html',
      1 => 1546904380,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c33e4388a93f2_58393313 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- inputs:
    tipo_formato, nombre, lugar, montaje, garantia, canapes, entrada, fuerte,
    postre, detalle_montaje, ama_llaves, chief_steward, mantenimiento,
    seguridad, recursos_humanos, proveedores, contabilidad
-->
<form id="tab_ceremonia" class="form col-xs-12" action="#" method="post">
    <input class="id_orden" type="hidden" name="id">

    <div class="row-between">
      <div class="col-xs-12 col-md-6">
        <div class="row-between scroll-y" style="padding: 0 20px">
          <input type="hidden" name="tipo_formato" value="ceremonia">

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
            <textarea wrap="off" class="o_observaciones col-xs-11" name="observaciones" rows="3"></textarea>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-md-6">
        <div id="campos_ceremonia" class="row-between scroll-y" style="padding: 0 20px">
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

    <div class="row-right">
      <button form="tab_ceremonia" class="btn success" type="button">Subir</button>
      <button form="tab_ceremonia"  class="btn atention" type="button">Editar</button>
      <button id="btnCampoExtraCeremonia" class="btn primary" type="button" >Mas <strong>+</strong></button>
    </div>
  </form>
  <!-- SCRIPT DE CAMPOS DINÁMICOS -->
<?php echo '<script'; ?>
>
  let nc_ceremonia = 0;

  btnCampoExtraCeremonia.addEventListener('click', () => {
    if (nc_ceremonia < 5) {
      const e = document.createElement('div');
      e.className = 'col-xs-6';
      e.innerHTML = `<input class="o_tag col-xs-7" type="text" name="tag[]"> <br>
      <textarea wrap="off" class="o_content col-xs-11" name="content[]" rows="3"></textarea>`;
      
      campos_ceremonia.appendChild(e);

      nc_ceremonia++;
    } else { alert('Se ha alcanzado el máximo de campos disponibles'); }    
  })
<?php echo '</script'; ?>
><?php }
}
