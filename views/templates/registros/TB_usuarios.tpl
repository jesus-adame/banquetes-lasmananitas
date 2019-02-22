<div class="t-scroll">
   <table class="table">
      <thead>
      <tr>
         <th class="col-xs-1"># ID</th>
         <th class="col-xs-3">Nombre</th>
         <th class="col-xs-2">Estado</th>
         <th class="col-xs-2">Roles</th>
         <th class="col-xs-3 col-md-2">
            <button id="btn_add_usuarios" class="btn primary" type="button">
            <i class="fas fa-plus-circle"></i> Agregar</button></th>
      </tr>
      </thead>
      <tbody id="tbody_usuarios">
      {foreach from=$usuarios item=row}
      <tr>
         <td>{$row.id_usuario}</td>
         <td>{$row.username}</td>
         <td>{if $row.estado eq 0}Inactivo{else}Activo{/if}</td>
         <td>{$row.nivel}</td>
         <td>
            <div class="row-around">                
               <button class="btn atention" type="button" name="button">
               <i class="fas fa-pen-alt"></i></button>
               <button class="btn danger" type="button" name="button">
               <i class="fas fa-trash-alt"></i></button>
            </div>
         </td>
      </tr>
      {/foreach}
      </tbody>
   </table>
</div>