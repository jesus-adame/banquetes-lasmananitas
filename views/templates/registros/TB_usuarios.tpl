<div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th># ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th><button id="btn_agregar_usuarios" class="btn primary" type="button">Agregar</button></th>
        </tr>
        </thead>
        <tbody id="tbody_usuarios">
        {foreach from=$usuarios item=row}
        <tr>
            <td>{$row.id_usuario}</td>
            <td>{$row.nombre_usuario}</td>
            <td>{if $row.estado eq 0}Inactivo{else}Activo{/if}</td>
            <td>
            <button class="btn atention" type="button" name="button">Editar</button><br>
            <button class="btn danger" type="button" name="button" style="margin-top:5px">Eliminar</button>
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>