<?php
/* Smarty version 3.1.33, created on 2019-01-08 20:24:26
  from 'C:\xampp\htdocs\banquetes\views\registros.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c34f8ea459150_34128387',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2b96a041397a5e7b262744ac2e13e3eda24821c3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\registros.html',
      1 => 1546975462,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:struct/header.html' => 1,
    'file:views/templates/registros/M_empleados.html' => 1,
    'file:views/templates/registros/M_usuarios.html' => 1,
    'file:views/templates/registros/M_validados.html' => 1,
    'file:views/templates/registros/TB_usuarios.tpl' => 1,
    'file:views/templates/registros/TB_empleados.tpl' => 1,
    'file:views/templates/registros/TB_validados.tpl' => 1,
    'file:struct/footer.html' => 1,
  ),
),false)) {
function content_5c34f8ea459150_34128387 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender('file:struct/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<main>
<?php $_smarty_tpl->_subTemplateRender('file:views/templates/registros/M_empleados.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:views/templates/registros/M_usuarios.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender('file:views/templates/registros/M_validados.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
  <div class="content m-auto">
    <hgroup>
      <h1><?php echo $_smarty_tpl->tpl_vars['titulo']->value;?>
</h1>
      <h2><?php echo $_smarty_tpl->tpl_vars['subtitulo']->value;?>
</h2>
    </hgroup>

    <div id="tabs_menu">

      <ul class="tabs">
        <li><a href="#tab1" class="tab active">Usuarios</a></li>
        <li><a href="#tab2" class="tab">Personal</a></li>
        <li><a href="#tab3" class="tab">Validados</a></li>
      </ul>

      <div class="tabs_content">
        <section id="tab1" class="tab_content show">
          <?php $_smarty_tpl->_subTemplateRender('file:views/templates/registros/TB_usuarios.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </section>
    
        <section id="tab2" class="tab_content">
          <?php $_smarty_tpl->_subTemplateRender('file:views/templates/registros/TB_empleados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </section>
    
        <section id="tab3" class="tab_content">
          <?php $_smarty_tpl->_subTemplateRender('file:views/templates/registros/TB_validados.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        </section>
      </div>
      
    </div>
    
  </div>
</main>
<?php echo '<script'; ?>
 src="views/js/registros/registros.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/registros/M_usuarios.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/registros/M_empleados.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/registros/M_validados.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/registros/ajax_request.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/registros/tab_usuarios.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="views/js/tabs.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
tabs('#tabs_menu');
<?php echo '</script'; ?>
>
<?php $_smarty_tpl->_subTemplateRender('file:struct/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
