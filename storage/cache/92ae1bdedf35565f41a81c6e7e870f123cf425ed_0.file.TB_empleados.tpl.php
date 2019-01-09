<?php
/* Smarty version 3.1.33, created on 2019-01-08 19:36:18
  from 'C:\xampp\htdocs\banquetes\views\templates\registros\TB_empleados.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34eda2620089_55633070',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '92ae1bdedf35565f41a81c6e7e870f123cf425ed' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\registros\\TB_empleados.tpl',
      1 => 1546972477,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c34eda2620089_55633070 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th># ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th><button id="btn_agregar_empleados" class="btn primary" type="button">Agregar</button></th>
        </tr>
        </thead>
        <tbody id="tbody_empleados">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['empleados']->value, 'row');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
?>
        <tr>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['id_empleado'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['nombre'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['apellido'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['depto'];?>
</td>
            <td><?php echo $_smarty_tpl->tpl_vars['row']->value['cargo'];?>
</td>
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
