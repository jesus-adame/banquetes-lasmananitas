<?php
/* Smarty version 3.1.33, created on 2019-01-06 22:14:04
  from 'C:\xampp\htdocs\banquetes\views\templates\MD_orden.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c326f9cbc5f49_13158952',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a03d313f5b8e1c8353d6b52df9ac50c2c8c8554' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\MD_orden.html',
      1 => 1546809242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:views/templates/eventos/tab_grupo.html' => 1,
    'file:views/templates/eventos/tab_ceremonia.html' => 1,
    'file:views/templates/eventos/tab_coctel.html' => 1,
    'file:views/templates/eventos/tab_banquete.html' => 1,
  ),
),false)) {
function content_5c326f9cbc5f49_13158952 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div id="md_orden" class="sub-modal">
  <div class="flex">
    <div class="modal-content col-xs-10">
      <div class="modal-header">
        <h3>Orden de Servicio</h3>
        <a class="close">&times;</a>
      </div>
      <div class="modal-body">

        <div id="tabs_ordenes" style="margin-bottom: 15px">

          <ul class="tabs">
            <li>
              <a href="#tab1" class="tab active">Grupo</a></li>
            <li>
              <a href="#tab2" class="tab">Ceremonia</a></li>
            <li>
              <a href="#tab3" class="tab">Coctel</a></li>
            <li>
              <a href="#tab4" class="tab">Banquete</a></li>
          </ul>

          <div class="tabs_content">
            
            <section id="tab1" class="tab_content show">
              <?php $_smarty_tpl->_subTemplateRender('file:views/templates/eventos/tab_grupo.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </section>

            <section id="tab2" class="tab_content">
              <?php $_smarty_tpl->_subTemplateRender('file:views/templates/eventos/tab_ceremonia.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </section>

            <section id="tab3" class="tab_content">
              <?php $_smarty_tpl->_subTemplateRender('file:views/templates/eventos/tab_coctel.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </section>

            <section id="tab4" class="tab_content">
                <?php $_smarty_tpl->_subTemplateRender('file:views/templates/eventos/tab_banquete.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            </section>

          </div>
        </div>

      </div> <!-- Fin del modal-body -->
    </div>
  </div>
</div>
<?php }
}
