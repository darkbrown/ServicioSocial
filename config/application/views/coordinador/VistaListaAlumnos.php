<div class="container-fluid ">

    <h2 name="titulo" id="titulo">Lista de Alumnos</h2>

    <div class="input-group">
        <i class="fa fa-search input-group-addon"></i>
        <input type="text" class="form-control" id="buscar" name="buscar" placeholder="Buscar en alumnos...">
        <a href="<?php echo base_url()?>index.php/FormularioAlumnoCoordinador" class="btn btn-dark">REGISTRAR ALUMNO</a>
    </div>

    <div class="table-responsive text-nowrap " >
        <table class=".table-responsive table-striped table-hover"  >
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
                    <input type="button" class="ver btn btn-sm btn-info" id="ver" name="ver" value="VER">
                    <input type="button" class="cambiarEstatus btn btn-sm btn-danger" id="cambiarEstatus" name="cambiarEstatus"
                        value=<?php if($item['estatus']=='ACTIVO' ){echo 'SUSPENDER' ;}else{echo 'ACTIVAR' ;}?>>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>

<div class="modal" id="modalConfirmacion" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">CAMBIAR ESTATUS DEL ALUMNO</h5>
            </div>
            <div class="modal-body">
                <div>
                    <label>Alumno:</label>
                    <label id="nombreAlumno" name="nombreAlumno"></label>
                </div>
                <div>
                    <label>Matrícula:</label>
                    <label id="matriculaAlumno" name="matriculaAlumno"></label>
                </div>
                <label id="textoConfirmacion" name="textoConfirmacion">¿Confirma que desea cambiar el estatus del alumno. Si el alumno cuenta con una sesión activa se
                    cerrará?</label>
            </div>
            <div class="modal-footer">
                <button type="submit" name="botonConfirmar" id="botonConfirmar" class="btn btn-primary">CONFIRMAR</button>
                <button type="button" name="botonCancelar" id="botonCancelar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalExitoso" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Estatus Cambiado Satisfactoriamente!!</h5>                   
                </div>
                <div class="modal-body">
                    <p>Cambio de estatus exitoso</p>
                </div>
                <div class="modal-footer">
                    <button type="button" name="botonCerrar" id="botonCerrar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/ListaAlumnos.js"></script>
