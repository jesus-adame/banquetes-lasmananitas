
<div class="box-tab">
  <div class="tabs">
    <ul>
      <li><a href="#tab1">Pagina</a> </li>
      <li><a href="#tab2">Pagina2</a> </li>
    </ul>
  </div>
  <form id="form_evento" class="form col-xs-12" action="#" method="post">
    <input id="e_id" type="hidden" name="id">

    <div class="col-xs-5">
      Titulo:<br>
      <input id="e_title" class="col-xs-12" type="text" name="titulo" required>

      <div class="col-xs-6">
        Evento:<br>
        <input id="e_evento" class="col-xs-11" type="text" name="evento" required>
      </div>

      <div class="col-xs-6">
        Personas:<br>
        <input id="personas" class="col-xs-12" type="number" name="personas" value="100">
      </div>

      <div class="col-xs-6">
        Fecha:<br>
        <input id="date" class="col-xs-11 line-block" type="date" name="fecha"><br>
        Hora inicio:<br>
        <div class="clockpicker" data-autoclose="true" data-placement="top">
          <input id="time" class="col-xs-11 line-block" type="time" name="hora" value="00:00"><br>
          <span class="glyphicon glyphicon-time"></span>
        </div>
      </div>
    </div>
  </form>
</div>
