<?php
/* Smarty version 3.1.33, created on 2019-01-04 00:52:56
  from 'C:\xampp\htdocs\banquetes\views\index.php' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2ea05857cd17_37428216',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dff8d1397835b029c76fb44862aa336722783ceb' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\index.php',
      1 => 1546559575,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c2ea05857cd17_37428216 (Smarty_Internal_Template $_smarty_tpl) {
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
 <?php echo '<?php ';?>echo ' Hola'; <?php echo '?>';?></h3>
    </hgroup>
    
    <p>USUARIO: <b><?php echo $_smarty_tpl->tpl_vars['usuario']->value;?>
</b></p>
    <p>ROL: <b><?php echo $_smarty_tpl->tpl_vars['puesto']->value;?>
</b></p><br>
    
    <div class="index-bg">
     <img src="storage/thumbs/index_bg.jpg" alt="Las mañanitas">
    </div>
  </div>
</main>
<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
