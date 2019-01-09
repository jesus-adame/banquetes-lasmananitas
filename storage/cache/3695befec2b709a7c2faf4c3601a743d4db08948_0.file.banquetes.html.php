<?php
/* Smarty version 3.1.33, created on 2019-01-03 23:53:50
  from 'C:\xampp\htdocs\banquetes\views\banquetes.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2e927e4629e3_45918091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3695befec2b709a7c2faf4c3601a743d4db08948' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\banquetes.html',
      1 => 1543891795,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c2e927e4629e3_45918091 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:struct/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>

  <div class="content m-auto">
    <hgroup>
      <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
      <h2><?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
</h2>
    </hgroup>

  </div>
</main>

<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
