<div id="M_sesion" class="modal">
  <div id="MS_flex" class="flex">
    <div class="modal-content m-sesion col-xs-10 col-sm-7 col-md-5 col-lg-3">
      <div class="modal-header">
        <h3>Iniciar Sesión</h3>
        <a id="MS_cerrar" class="close">&times;</a>
      </div>
      <div class="modal-body">
        <form id="form_sesion" class="form" action="core/sesionAjaxController.php" method="post">
          Usuario:
          <input class="col-xs-12" type="text" name="usuario" value="">
          Contraseña:
          <input class="col-xs-12" type="password" name="pass" value=""><br><br>

          <button class="btn primary" type="submit" name="button">Ingresar</button>
        </form>
      </div>
    </div>
  </div>
</div>
