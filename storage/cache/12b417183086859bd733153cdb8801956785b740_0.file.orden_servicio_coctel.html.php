<?php
/* Smarty version 3.1.33, created on 2019-01-08 01:18:17
  from 'C:\xampp\htdocs\banquetes\views\templates\pdf\orden_servicio_coctel.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c33ec49135a11_24536825',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '12b417183086859bd733153cdb8801956785b740' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\pdf\\orden_servicio_coctel.html',
      1 => 1546906694,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c33ec49135a11_24536825 (Smarty_Internal_Template $_smarty_tpl) {
?><style media="screen">
  h1, h3 {
    text-align: center;
    font-size: 16;
  }
  pre {
    font-family: 'arial';
    font-size: 9;
    letter-spacing: 2px;
    line-height: 2.4mm;
    padding-left: 2mm;
  }
  p {
    padding-left: 4mm;
    padding: 0;
  }
  ul {
    line-height: 0;
    padding: 0;
  }
  table {
    border-collapse: collapse;
  }
  .tabla {
    text-align: center;
    font-size: 9;
  }
  .tabla tr, .tabla td, .tabla th {
    border: solid 1 #3b3b3b;
  }
  .tabla td {
    width: 20%;
  }
  .tabla2 {
    margin: auto;
    font-size: 8;
  }
  .tabla2 tr, .tabla2 td, th {
    border: solid 1 #3b3b3b;
  }
  .tabla2 td {
    width: 13%;
  }
  .thead td, th {
    text-align: center;
    background: #dadada;
    font-size: 2.5mm;
    font-weight: bold;
    height: 1mm;
  }
  .th, th {
    text-align: center;
    font-weight: bold;
    padding: 0;
    background: #dadada;
    font-size: 2mm;
  }
  .content {
    width: 85%;
    margin: auto;
  }
</style>

<page>
  <page_header backtop="10mm" backbottom="20mm" backleft="10mm" backright="10mm">
    <table class="content page_header">
      <tr>
        <td>
          <h1>ORDEN DE SERVICIO</h1>
        </td>
      </tr>
    </table>
  </page_header>

  <table class="content tabla" style="padding-top:10mm;padding-bottom: 5mm">

    <tr>
      <th rowspan="2" style="background: #fff; border-top:0;border-bottom:0;border-left:0">
      <img src="storage/thumbs/lms.png" style="width: 25mm;margin-right:8mm">
      </th>
      <th style="line-height:2mm;padding-top:-3mm" colspan="4">
        <h3 style="margin: auto;"><?php echo $_smarty_tpl->tpl_vars['fecha']->value;?>
</h3>
      </th>
      <th rowspan="2" style="background:#fff; border-top:0;border-bottom:0;border-right:0">
      <img src="storage/thumbs/lms.png" style="width:25mm;margin-left:8mm">
      </th>
    </tr>

    <tr>
      <td>
        <b>TITULO:</b> <br>
        <b>CONTACTO:</b> <br>
        <b>EVENTO:</b> <br>
        <b>NOTA:</b>
      </td>
      <td>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['title'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['contacto'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['evento'];?>
<br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['orden'];?>

      </td>
      <td>
        <b>FOLIO:</b> <br>
        <b>CORDINADORA RESP:</b> <br>
        <b>CORDINADORA APOYO:</b> <br>
        <b>VENDEDOR:</b> <br>
      </td>
      <td>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['id_orden'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['cord_resp'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['cord_apoyo'];?>
 <br>
        <?php echo $_smarty_tpl->tpl_vars['data']->value['cord_resp'];?>
 <br>
      </td>
    </tr>
  </table>

  <table class="tabla2">
    <tr class="thead">
      <td>HORARIO</td>
      <td>SALÓN</td>
      <td>EVENTO</td>
      <td>MONTAJE</td>
      <td>GARANTIA</td>
      <td></td>
      <td>CLAVE EVENTO</td>
    </tr>
    <tr class="thead">
      <td><?php echo $_smarty_tpl->tpl_vars['hora']->value;?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['data']->value['lugar'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['data']->value['orden'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['data']->value['montaje'];?>
</td>
      <td><?php echo $_smarty_tpl->tpl_vars['data']->value['garantia'];?>
</td>
      <td></td>
      <td>PENDIENTE</td>
    </tr>

    <tr class="thead">
      <td colspan="3">ALIMENTOS Y BEBIDAS</td>
      <td colspan="4">COORDINACIÓN OPERATIVA</td>
    </tr>
    <tr class="thead">
      <td colspan="3">CANAPES</td>
      <td colspan="4">MONTAJE</td>
    </tr>

    <tr>
      <td id="alimentos_bebidas" colspan="3">
      <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['canapes'] != '') {
echo $_smarty_tpl->tpl_vars['data']->value['canapes'];?>

<?php } else { ?>
N/A
<?php }?>
      </pre>
      </td>

      <td id="montaje" colspan="4">
      <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['detalle_montaje'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['detalle_montaje'];?>

<?php }?>
      </pre>
      </td>
    </tr>

    <tr>
      <th colspan="3">AGUAS FRESCAS</th>
      <th colspan="4">AMA DE LLAVES</th>
    </tr>

    <tr>
      <td id="aguas_frescas" colspan="3">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['ama_llaves'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['ama_llaves'];?>
  
<?php }?>
          </pre>
        </td>

      <td id="ama_llaves" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['ama_llaves'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['ama_llaves'];?>
  
<?php }?>
        </pre>
      </td>
    </tr>

    <tr>
      <th colspan="3">COCTELERIA</th>
      <th colspan="4">CHIEF STEWARD</th>
    </tr>

    <tr>
      <td id="cocteleria" colspan="3">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['cocteleria'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['cocteleria'];?>

<?php }?>
          </pre>
      </td>

      <td id="chief_steward" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['chief_steward'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['chief_steward'];?>

<?php }?>
        </pre>
      </td>
    </tr>
  
    <tr>
      <th colspan="3">MEZCLADORES</th>
      <th colspan="4">SEGURIDAD</th>
    </tr>

    <tr>
      <td id="mezcladores" colspan="3">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['mezcladores'] != '') {
echo $_smarty_tpl->tpl_vars['data']->value['mezcladores'];?>

<?php } else { ?>
N/A
<?php }?>
        </pre>
      </td>

      <td id="seguridad" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['seguridad'] != '') {
echo $_smarty_tpl->tpl_vars['data']->value['seguridad'];?>

<?php } else { ?>
N/A
<?php }?>
        </pre>
      </td>
    </tr>

    <tr>
      <th colspan="3">BEBIDAS</th>
      <th colspan="4">MANTENIMIENTO</th>
    </tr>
    <tr>
      <td id="bebidas" colspan="3">
      <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['bebidas'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['bebidas'];?>

<?php }?>
      </pre>
      </td>
      <td id="mantenimiento" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['mantenimiento'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['mantenimiento'];?>

<?php }?>
        </pre>
      </td>
    </tr>

    <tr style="position:relative">
    <th colspan="3">--- LOGISTICA ---</th>


      <th colspan="4">RECURSOS HUMANOS</th>
    </tr>
    <tr>
      <td id="logistica" colspan="3" rowspan="14">
        <table class="tabla2" style="height: 100mm; margin-top:0; text-align:center">
          <tr>
            <th style="width: 22mm">FECHA</th>
            <th style="width: 22mm">HORA</th>
            <th style="width: 40mm">ACTIVIDAD</th>
            <th style="width: 40mm">LUGAR</th>
          </tr>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['act']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
          <?php $_smarty_tpl->_assignInScope('inicio', explode(" ",$_smarty_tpl->tpl_vars['row']->value['start']));?> 
          <tr style="line-height: 0;">
            <td><?php echo $_smarty_tpl->tpl_vars['inicio']->value[0];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['inicio']->value[1];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['title'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['lugar'];?>
</td>
          </tr>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </table>
      </td>
      <td id="recursos_humanos" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['recursos_humanos'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['recursos_humanos'];?>

<?php }?>
        </pre>
      </td>
    </tr>

<?php if ($_smarty_tpl->tpl_vars['data']->value['proveedores'] != '') {?>
    <tr>
      <th colspan="4">PROVEEDORES</th>
    </tr>
    <tr>
      <td id="proveedores" colspan="4">
        <pre>
<?php echo $_smarty_tpl->tpl_vars['data']->value['proveedores'];?>

        </pre>
      </td>
    </tr>
<?php }?>

    <tr>
      <th colspan="4">CONTABILIDAD Y RESTAURANTE</th>
    </tr>
    <tr>
      <td id="contabilidad_restaurante" colspan="4">
        <pre>
<?php if ($_smarty_tpl->tpl_vars['data']->value['contabilidad'] == '') {?>
N/A
<?php } else {
echo $_smarty_tpl->tpl_vars['data']->value['contabilidad'];?>

<?php }?>
        </pre>
      </td>
    </tr>

    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['d_data']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
    <tr>
      <th colspan="4"><?php echo $_smarty_tpl->tpl_vars['row']->value['tag'];?>
</th>
    </tr>
    <tr>
      <td colspan="4">
        <pre>
<?php echo $_smarty_tpl->tpl_vars['row']->value['content'];?>

        </pre>
      </td>
    </tr>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  </table>
</page>
<?php }
}
