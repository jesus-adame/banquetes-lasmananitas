<?php
/* Smarty version 3.1.33, created on 2019-01-09 01:06:20
  from 'C:\xampp\htdocs\banquetes\views\templates\M_evento.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.33',
  'unifunc' => 'content_5c353afc333931_91744562',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1e01702527daf54a5c48efdcd35efd9851b9ec50' => 
    array (
      0 => 'C:\\xampp\\htdocs\\banquetes\\views\\templates\\M_evento.html',
      1 => 1546992371,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5c353afc333931_91744562 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="M_evento" class="modal">
  <div class="flex">
    <div class="modal-content col-xs-11 col-md-9">
      <div class="modal-header">
        <h3>Evento</h3>
        <ul class="tabs">
          <li>
            <button id="btnDetalleEvento" class="btn primary" type="button">Detalles</button>
          </li>
        </ul>
      </div>
      <div class="modal-body">
        <form id="form_evento" class="form col-xs-12" action="#" method="post">
          <input id="e_id" type="hidden" name="id">

          <div class="row-between">
            <div class="col-xs-12 col-sm-5">
              Titulo: *<br>
              <input id="e_title" class="col-xs-12" type="text" name="titulo" required>

              <div class="row-between">
                <div class="col-xs-6">
                  Evento: *<br>
                  <input id="e_evento" class="col-xs-11" type="text" name="evento">
                </div>

                <div class="col-xs-6">
                  Personas: *<br>
                  <input id="personas" class="col-xs-12" type="number" name="personas">
                </div>
              </div>

              <div class="row-between">
                <div class="col-xs-6">
                  Fecha:<br>
                  <input id="date_start" class="col-xs-11 line-block" type="date" 
                  min="1900-04-01" name="fecha"><br>
                  Hora inicio:<br>
                  <input id="time" class="col-xs-11 line-block" type="time" name="hora"><br>
                </div>

                <div class="col-xs-6">
                  Fecha final:<br>
                  <input id="date_end" class="col-xs-12" type="date" name="fecha"><br>
                  Hora final:<br>
                  <input id="time_f" class="col-xs-12" type="time" name="hora"><br>
                </div>

                <div class="col-xs-6">
                  Status:<br>
                  <select id="color" class="col-xs-11" name="color">
                    <option id="old_color" value="#d7c735">- Elegir -</option>
                    <option value="#d7c735">Tentativo</option>
                    <option value="#f98710">Apartado</option>
                    <?php if ($_SESSION['puesto'] == 'Supervisor' || $_SESSION['puesto'] == 'Administrador') {?>
                    <option value="#e62424">Cerrado</option>
                    <?php }?>
                  </select>
                </div>

                <div class="col-xs-6">
                  Categoria:<a id="txtcategoria"></a><br>
                  <select id="categoria" class="col-xs-12" name="categoria">
                    <option id="idcategoria" value="Privado">- Seleccionar -</option>
                    <option value="Social"> Social </option>
                    <option value="Privado"> Empresarial </option>
                    <option value="Privado"> Casa </option>
                  </select>
                </div>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6">
              Contacto: *<br>
              <input id="e_contacto" class="col-xs-12" type="text" name="contacto" required>

              <div class="row-between">
                <div class="col-xs-6">
                  Cord. Responsable: *<br>
                  <input id="e_cord_resp" class="col-xs-11" type="text" name="titulo" required>
                </div>

                <div class="col-xs-6">
                  Cord. Apoyo:<br>
                  <input id="e_cord_apoyo" class="col-xs-12" type="text" name="titulo" required>
                </div>
              </div>

              Salón: <a id="e_place"></a>
              <select id="idlugar" class="col-xs-12" name="idlugar" required>
                <!-- <option value="0">- Cambiar -</option>
                <option value="1">Casa Nueva</option>
                <option value="2">Jardin Privado</option> -->
              </select><br>
              Descripción:<br>
              <textarea id="e_description" class="col-xs-12" name="descrip" rows='3'></textarea>
            </div>
          </div>
        </form>

        <div class="modal-footer">
            <button class="btn default cerrar">Cancel</button>
            <button id="btnModificar" class="btn atention" onclick="modificarEvento()">Modificar</button>
            <button id="btnBorrar" class="btn danger" onclick="eliminarEvento()">Borrar</button>
            <button id="btnAgregarEvento" class="btn primary" onclick="addEvento()">Agregar</button>
          </div>
      </div>
      
    </div>
  </div>
</div>
<?php }
}
