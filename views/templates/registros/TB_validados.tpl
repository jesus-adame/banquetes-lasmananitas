<div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th># Usuario</th>
            <th>Empleado</th>
            <th>Roles</th>
            <th><button id="btn_agregar_validados" class="btn primary" type="button">Agregar</button></th>
        </tr>
        </thead>
        <tbody id="tbody_validados">
        {foreach from=$validados item=row}
        <tr>
            <td>{$row.id_usuario}</td>
            <td>{$row.nombre} {$row.apellido}</td>
            <td>{$row.puesto}</td>
            <td>
            <button class="btn atention" type="button" name="button">Editar</button><br>
            <button class="btn danger" type="button" name="button" style="margin-top:5px">Eliminar</button>
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>