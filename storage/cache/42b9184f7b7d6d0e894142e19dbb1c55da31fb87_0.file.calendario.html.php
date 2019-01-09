<?php
/* Smarty version 3.1.33, created on 2019-01-03 17:20:58
  from 'C:\xampp\htdocs\banquetes\views\calendario.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2e366a91cc05_14063502',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '42b9184f7b7d6d0e894142e19dbb1c55da31fb87' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\calendario.html',
      1 => 1546532425,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:templates/calendario/M_evento.tpl' => 1,
    'file:templates/calendario/MD_evento.tpl' => 1,
    'file:templates/calendario/MD_logistica.tpl' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c2e366a91cc05_14063502 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:struct/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/calendario/M_evento.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/calendario/MD_evento.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <?php $_smarty_tpl->_subTemplateRender('file:templates/calendario/MD_logistica.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

  <div class="content m-auto">
    <hgroup>
      <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
      <h2><?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
</h2>
    </hgroup>

    <div id="calendar" class="calendar"></div>

  </div>
</main>

<?php echo '<script'; ?>
 src="views/js/calendario/funcs_events.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario/M_evento.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario/MD_evento.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario/MD_logistica.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario/evento_ajax.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/calendario/calendario.js"><?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
