<?php
/* Smarty version 3.1.33, created on 2019-01-03 17:18:59
  from 'C:\xampp\htdocs\banquetes\views\struct\footer.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c2e35f362d8b0_96525156',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '24afcd6559f2e7bb4562ff654eb6982e567476b6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\struct\\footer.html',
      1 => 1546532325,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:templates/M_sesion.tpl' => 1,
  ),
),false)) {
function content_5c2e35f362d8b0_96525156 (Smarty_Internal_Template $_smarty_tpl) {
?><footer>
  <div class="content m-auto">
    <div class="row-between">
      <address>
        <small>Copyright Las Mañanitas 2018 &copy;</small>
      </address>
      <div>
        <?php if (isset($_SESSION['usuario'])) {?>
        <button class="btn" onclick="cerrarSesion()" type="button" name="button">
          <i class="fas fa-sign-out-alt"></i> Logout
        </button>
        <?php } else { ?>
        <button class="btn" onclick="abrirMSesion()" type="button" name="button">
          <i class="fas fa-sign-in-alt"></i> Login
        </button>
        <?php }?>
      </div>
    </div>
  </div>
</footer>
<?php $_smarty_tpl->_subTemplateRender('file:templates/M_sesion.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
</body>
<?php echo '<script'; ?>
 src="views/lib/jquery-clockpicker.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
> $('.clockpicker').clockpicker(); <?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/M_sesion.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/sesion_ajax.js"><?php echo '</script'; ?>
>
</html>
<?php }
}
