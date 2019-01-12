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
                <a href="#" class="editar btn btn-sm btn-warning">EDITAR</a>
                <a href="#" class="consultar btn btn-sm btn-info">CONSULTAR</a>
                <a href="#" class="cambiarEstatus btn btn-sm btn-danger">
                    <?php if($item['estatus']=='ACTIVO'){echo 'SUSPENDER';}else{echo 'ACTIVAR';}?></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</div>


</body>

</html>
<script type="text/javascript" src="<?php echo base_url();?>js/ListaAlumnos.js"></script>