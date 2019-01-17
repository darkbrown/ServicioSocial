
<div class="container-fluid">

    <h2 name="titulo" id="titulo">Lista de Alumnos</h2>

    <div class="input-group">
		<i class="fa fa-search input-group-addon"></i>
		<input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar en alumnos...">
        <input type="button" class="btn btn-dark" value="REGISTRAR ALUMNO"></input>
    </div>
    
    <div class="table-responsive text-nowrap">
    <table class="table table-striped table-hover ">
        <thead class="encabezadoTabla">
            <th>ESTATUS</th>
            <th>NOMBRE</th>
            <th>MATRÍCULA</th>
            <th>CORREO ELECTRÓNICO</th>
            <th>TELÉFONO</th>
            <th>ACCIONES</th>
        </thead>

        <?php if(isset($listaAlumnos)) foreach ($listaAlumnos as $item):  ?>
        <tr>
            <td>
                <?php echo $item['estatus'] ?>
            </td>
            <td>
                <?php echo $item['nombre'] .' ' . $item['apellidos'] ?>
            </td>
            <td>
                <?php echo $item['matricula'] ?>
            </td>
            <td>
                <?php echo $item['correo'] ?>
            </td>
            <td>
                <?php echo $item['telefono'] ?>
            </td>
            <td>
                <input type="button" class="editar btn btn-sm btn-warning" id="editar" name="editar" value="EDITAR">
                <input type="button" class="consultar btn btn-sm btn-info" id="consultar" name="consultar" value="VER">
                <input type="button" class="cambiarEstatus btn btn-sm btn-danger" id="cambiarEstatus" name="cambiarEstatus" value=<?php if($item['estatus']=='ACTIVO'){echo 'SUSPENDER';}else{echo 'ACTIVAR';}?>>      
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>

</body>

</html>
<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/ListaAlumnos.js"></script>