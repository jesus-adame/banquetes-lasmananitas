<?php
/* Smarty version 3.1.33, created on 2019-01-06 23:52:21
  from 'C:\xampp\htdocs\banquetes\views\templates\eventos\tab_grupo.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c3286a54696f5_58401212',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4144d6ef4045c971821c64685dbecf5d8186ae8' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\eventos\\tab_grupo.html',
      1 => 1546815139,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c3286a54696f5_58401212 (Smarty_Internal_Template $_smarty_tpl) {
?><!-- inputs:
  tipo_formato, nombre, lugar, montaje, garantia, canapes,
  detalle_montaje, ama_llaves, chief_steward, mantenimiento,
  seguridad, recursos_humanos, proveedores, contabilidad
-->
<form id="tab_grupo" class="form col-xs-12" action="core/ajax" method="post">
  <input class="id_orden" type="hidden" name="id">

  <div class="row-between">
    <!-- CAMPOS DE LA IZQUIERDA -->
    <div class="col-xs-12 col-md-6">
      <div class="row-between scroll-y" style="padding: 0 20px">
        <input type="hidden" name="tipo_formato" value="grupo">
        <div class="col-xs-6">
          Evento *:<br>
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
          Alimentos:<br>
          <textarea wrap="off" class="o_canapes col-xs-11" name="canapes" rows="3"></textarea>
        </div>

        <div class="col-xs-6">
          Notas (Observaciones):<br>
          <textarea wrap="off" class="o_observaciones col-xs-12" name="observaciones" rows="3"></textarea>
        </div>
        
      </div>
    </div>
    <!-- CAMPOS DE LA DERECHA -->
    <div class="col-xs-12 col-md-6">
      <div id="campos_grupo" class="row-between scroll-y" style="padding: 0 20px">
          <div class="col-xs-6">
            Detalle montaje:<br>
            <textarea wrap="off" class="o_dmontaje col-xs-11" name="detalle_montaje" rows="3"></textarea>
          </div>
          
          <div class="col-xs-6">
            Ama de llaves:<br>
            <textarea wrap="off" class="o_ama_llaves col-xs-11" name="ama_llaves" rows="3"></textarea>
          </div>
          
          <div class="col-xs-6">
            Chief Steward:<br>
            <textarea wrap="off" class="o_chief_steward col-xs-11" name="chief_steward" rows='3'></textarea>
          </div>
          
          <div class="col-xs-6">
            Mantenimiento:<br>
            <textarea wrap="off" class="o_mantenimiento col-xs-11" name="mantenimiento" rows='3'></textarea>
          </div>
          
          <div class="col-xs-6">
            Contabilidad y Restaurante:<br>
            <textarea wrap="off" class="o_contabilidad col-xs-11" name="contabilidad" rows="3"></textarea>
          </div>
        </div>
      </div>
    </div>
    <!-- BARRA INFERIOR -->
    <div class="row-right">
        <button form="tab_grupo" class="btn success" type="button">Subir</button>
        <button form="tab_grupo" class="btn atention" type="button">Editar</button>
        <button id="btnCampoExtra" class="btn primary" type="button" >Mas <strong>+</strong></button>
    </div>
    
  </form>
  <!-- SCRIPT DE CAMPOS DINÁMICOS -->
<?php echo '<script'; ?>
>
  let nc_grupo = 0;

  btnCampoExtra.addEventListener('click', () => {
    if (nc_grupo < 5) {
      const e = document.createElement('div');
      e.className = 'col-xs-6';
      e.innerHTML = `<input class="o_tag col-xs-7" type="text" name="tag[]"> <br>
      <textarea wrap="off" class="o_content col-xs-11" name="content[]" rows="3"></textarea>`;
      
      campos_grupo.appendChild(e)

      nc_grupo++;
    } else { alert('Se ha alcanzado el máximo de campos disponibles'); }    
  })
<?php echo '</script'; ?>
><?php }
}
