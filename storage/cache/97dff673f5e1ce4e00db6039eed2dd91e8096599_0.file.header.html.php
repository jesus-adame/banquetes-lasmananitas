<?php
/* Smarty version 3.1.33, created on 2019-01-04 20:24:51
  from 'C:\xampp\htdocs\banquetes\views\struct\header.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2fb303cf65b8_42324777',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '97dff673f5e1ce4e00db6039eed2dd91e8096599' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\struct\\header.html',
      1 => 1546629886,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/dependencies.html' => 1,
  ),
),false)) {
function content_5c2fb303cf65b8_42324777 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="es" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="viewport" content="initial-scale=1">
    <title><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</title>
    <?php $_smarty_tpl->_subTemplateRender('file:struct/dependencies.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  </head>
  <body>
  <header>
    <div class="content m-auto row-between">
      <img src="storage/thumbs/logo-blanco.png" alt="Las Mañanitas">
        
      <nav>
        <ul id="navbar" class="row-right">
          <li>
            <a class="btn-h <?php if (!isset($_GET['view']) || $_GET['view'] == 'index') {?>active<?php }?>" href="?view=index">
              <i class="fas fa-home"></i> Inicio
            </a>
          </li>
          <?php if (isset($_SESSION['puesto'])) {?>
          <li>
            <a class="btn-h <?php if ($_GET['view'] == 'calendario') {?>active<?php }?>" href="?view=calendario">
              <i class="far fa-calendar-alt"></i> Calendario
            </a>
          </li>
            <?php if ($_SESSION['puesto'] == 'Ventas' || $_SESSION['puesto'] == 'Supervisor' || $_SESSION['puesto'] == 'Administrador') {?>
          <li>
            <a class="btn-h <?php if ($_GET['view'] == 'eventos') {?>active<?php }?>" href="?view=eventos">
              <i class="far fa-calendar-check"></i> Eventos</a> 
          </li>
            <?php }?>
            <?php if ($_SESSION['puesto'] == 'Administrador') {?>
          <li>
            <a class="btn-h <?php if ($_GET['view'] == 'registros') {?>active<?php }?>" href="?view=registros">
              <i class="fas fa-users-cog"></i> Personal
            </a>
          </li>
          <li>
            <a class="btn-h <?php if ($_GET['view'] == 'banquetes') {?>active<?php }?>" href="?view=banquetes">
              <i class="fas fa-utensils"></i> Banquetes
            </a>
          </li>
           <?php }?>
          <?php }?>
        </ul>
      </nav>
    </div>
  </header><?php }
}
