<?php
/* Smarty version 3.1.33, created on 2019-01-04 20:00:59
  from 'C:\xampp\htdocs\banquetes\views\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2fad6b99b610_19941946',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'af8cb33d5d953234ebfc45691fe94f0cb00859f4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\index.html',
      1 => 1546628458,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c2fad6b99b610_19941946 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:struct/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
  <div class="content m-auto">
    <hgroup>
      <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
      <h2><?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
</h2>
      <h3>No. de Sesión <?php echo $_smarty_tpl->tpl_vars['id_usuario']->value;?>
</h3>
    </hgroup>
    
    <p>USUARIO: <strong><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</strong></p>
    <p>ROL: <strong><?php echo $_smarty_tpl->tpl_vars['puesto']->value;?>
</strong></p><br>
    
    <div class="index-bg">
     <img src="storage/thumbs/index_bg.jpg" alt="Las mañanitas">
    </div>
  </div>
</main>
<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
