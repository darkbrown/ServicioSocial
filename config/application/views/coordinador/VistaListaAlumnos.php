<div class="container-fluid ">
    <h2 name="titulo" id="titulo">Alumnos</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover" id="tablaAlumnos" name="tablaAlumnos">
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
                        <?php echo $item['nombreAlumno'] .' ' . $item['apellidosAlumno'] ?>
                    </td>
                    <td>
                        <?php echo $item['matriculaAlumno'] ?>
                    </td>
                    <td>
                        <?php echo $item['correoUsuario'] ?>
                    </td>
                    <td>
                        <?php echo $item['telefonoAlumno'] ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="editar btn btn-default btn-rounded" id="editar" name="editar">
                                <i class="fa fa-pencil-square-o" title="Editar Alumno"></i>
                            </a>
                            <a class="ver btn btn-default" id="ver" name="ver">
                                <i class="fa fa-eye" title="Consultar Alumno"></i>
                            </a>
                            <?php if($item['estatusUsuario']=='ACTIVO' ){
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

<a href="#" class="registrarAlumno btn btn-dark fixed-bottom botonF1 ml-auto">+</a>

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
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.dataTables.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/dataTables.bootstrap4.css" />
    <script type="text/javascript" src="<?php echo base_url();?>js/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>