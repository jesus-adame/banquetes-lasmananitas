<div class="t-scroll">
    <table class="table">
        <thead>
        <tr>
            <th># ID</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Departamento</th>
            <th>Cargo</th>
            <th><button id="btn_agregar_empleados" class="btn primary" type="button">Agregar</button></th>
        </tr>
        </thead>
        <tbody id="tbody_empleados">
        {foreach from=$empleados item=row}
        <tr>
            <td>{$row.id_empleado}</td>
            <td>{$row.nombre}</td>
            <td>{$row.apellido}</td>
            <td>{$row.depto}</td>
            <td>{$row.cargo}</td>
            <td>
            <button class="btn atention" type="button" name="button">Editar</button><br>
            <button class="btn danger" type="button" name="button" style="margin-top:5px">Eliminar</button>
            </td>
        </tr>
        {/foreach}
        </tbody>
    </table>
</div>