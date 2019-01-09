<?php
/* Smarty version 3.1.33, created on 2019-01-09 17:02:05
  from 'C:\xampp\htdocs\banquetes\views\eventos.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c361afde7c734_22600806',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '920a43ea136e4f8ff7e4cf61820266a283c5e13e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\eventos.html',
      1 => 1547049561,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:templates/M_evento.html' => 1,
    'file:templates/MD_evento.html' => 1,
    'file:templates/MD_logistica.html' => 1,
    'file:templates/eventos/form_eliminar_log.html' => 1,
    'file:templates/MD_orden.html' => 1,
    'file:templates/eventos/form_eliminar_orden.html' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c361afde7c734_22600806 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:struct/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/M_evento.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/MD_evento.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/MD_logistica.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/eventos/form_eliminar_log.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/MD_orden.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/eventos/form_eliminar_orden.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <div class="content m-auto">
    <hgroup>
      <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
 <i class="fas fa-cogs" style="color: #808080;"></i></h1><br>
      <h2><?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
</h2>
    </hgroup>

    <div id="calendar"></div>
  </div>
</main>

<?php echo '<script'; ?>
 src="views/js/obtener_lugares.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/funcs_events.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/M_evento.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/MD_evento.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/MD_orden.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/MD_logistica.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/eventos/evento_ajax.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/tabs.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>tabs('#tabs_ordenes');<?php echo '</script'; ?>
>

<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
