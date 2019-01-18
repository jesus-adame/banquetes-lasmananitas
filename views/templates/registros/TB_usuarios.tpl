<div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th class="col-xs-1"># ID</th>
            <th class="col-xs-3">Nombre</th>
            <th class="col-xs-2">Estado</th>
            <th class="col-xs-2">Roles</th>
            <th class="col-xs-3">
                <button id="btn_add_usuarios" class="btn primary" type="button">Agregar</button></th>
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
                    <button class="btn atention" type="button" name="button">Editar</button>
                    <button class="btn danger" type="button" name="button">Eliminar</button>
                </div>
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>