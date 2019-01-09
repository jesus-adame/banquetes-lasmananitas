<?php
/* Smarty version 3.1.33, created on 2019-01-08 19:36:18
  from 'C:\xampp\htdocs\banquetes\views\templates\registros\TB_usuarios.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34eda25004f2_40517570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f6c7b9da1a81c754a81cbed6fdff2dab9854ed6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\registros\\TB_usuarios.tpl',
      1 => 1546972454,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c34eda25004f2_40517570 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th># ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th><button id="btn_agregar_usuarios" class="btn primary" type="button">Agregar</button></th>
        </tr>
        </thead>
        <tbody id="tbody_usuarios">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['usuarios']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['id_usuario'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre_usuario'];?>
</td>
            <td><?php if ($_smarty_tpl->tpl_vars['row']->value['estado'] == 0) {?>Inactivo<?php } else { ?>Activo<?php }?></td>
            <td>
            <button class="btn atention" type="button" name="button">Editar</button><br>
            <button class="btn danger" type="button" name="button" style="margin-top:5px">Eliminar</button>
            </td>
        </tr>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </tbody>
    </table>
</div><?php }
}
