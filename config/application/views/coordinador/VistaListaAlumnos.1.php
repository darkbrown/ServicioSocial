<div class="container-fluid ">

    <h2 name="titulo" id="titulo">Lista de Alumnos</h2>

    
    <div class="table-responsive">
    <a href="<?php echo base_url()?>index.php/FormularioAlumno/coordinador" class="registrarAlumno float-left btn btn-dark">REGISTRAR ALUMNO</a>
        <table class=".table-responsive table table-striped table-sm table-hover" data-toggle="table" id="table" name="table"
             data-pagination="true" data-page-list="[5, 10, 25, 50, 100, Unlimited]" data-page-size="5"
                data-search="true" data-search-time-out="1" data-show-footer="true" formatShowingRows="false" 
                data-show-toggle ="true">
            <thead class="encabezadoTabla">
                <th data-sortable="true">NOMBRE</th>
                <th data-sortable="true">MATRÍCULA</th>
                <th data-sortable="true">CORREO ELECTRÓNICO</th>
                <th data-sortable="true">TELÉFONO</th>
                <th data-sortable="true">ACCIONES</th>
            </thead>
            <tbody>
                <?php if(isset($listaAlumnos)) foreach (array_reverse($listaAlumnos) as $item):  ?>
                <tr>
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
                        <div class="btn-group">
                            <a class="editar btn btn-default btn-rounded" id="editar" name="editar">
                                <i class="fa fa-pencil-square-o" title="Editar Alumno"></i>
                            </a>
                            <a class="ver btn btn-default" id="ver" name="ver">
                                <i class="fa fa-eye" title="Consultar Alumno"></i>
                            </a>
                            <?php if($item['estatus']=='ACTIVO' ){
                            echo '
                            <a class="cambiarEstatus btn btn-default" id="cambiarEstatus" name="cambiarEstatus">
                            <i class="fa fa-toggle-on " title="Cuenta Alumno Activa"></i>
                            </a>';
                        }else{
                                echo '
                            <a class="cambiarEstatus btn btn-default" id="cambiarEstatus" name="cambiarEstatus">
                            <i class="fa fa-toggle-off " title="Cuenta Alumno Suspendida"></i>
                            </a>';
                            }
                        ?>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
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
                <label id="textoConfirmacion" name="textoConfirmacion">¿Confirma que desea cambiar el estatus del
                    alumno. Si el alumno cuenta con una sesión activa se
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