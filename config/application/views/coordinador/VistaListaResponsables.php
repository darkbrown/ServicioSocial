<div class="container-fluid ">
    <h2 name="titulo" id="titulo">Responsables de Proyectos</h2>
    <div class="table-responsive">
        <table class="table table-striped table-sm table-hover" id="tablaResponsables" name="tablaResponsables">
            <thead class="encabezadoTabla">
                <th data-sortable="true">RESPONSABLE</th>
                <th data-sortable="true">DEPENDENCIA</th>
                <th data-sortable="true">CORREO RESPONSABLE</th>
                <th data-sortable="true">TEL. RESPONSABLE</th>
                <th data-sortable="true">ACCIONES</th>
            </thead>
            <tbody>
                <?php if(isset($listaResponsables)) foreach (array_reverse($listaResponsables) as $item):  ?>
                <tr>
                    <td>
                        <?php echo $item['nombreResponsable'] .' ' . $item['apellidosResponsable'] ?>
                    </td>
                    <td>
                        <?php echo $item['nombreDependencia'] ?>
                    </td>
                    <td>
                        <?php echo $item['correoUsuario'] ?>
                    </td>
                    <td>
                        <?php if($item['extensionResponsable'] == ''){echo $item['telefonoResponsable'];}else{echo $item['telefonoResponsable'] .' Ext. ' .$item['extensionResponsable'];} ?>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="editar btn btn-default btn-rounded" style="cursor:pointer" id="editar" name="editar">
                                <i class="fa fa-pencil-square-o" title="Editar Responsable"></i>
                            </a>
                            <a class="ver btn btn-default" id="ver" style="cursor:pointer" name="ver">
                                <i class="fa fa-eye" title="Consultar Responsable"></i>
                            </a>
                            <?php if($item['estatusUsuario']=='ACTIVO' ){
                            echo '
                            <a class="cambiarEstatus btn btn-default" style="cursor:pointer" id="cambiarEstatus" name="cambiarEstatus">
                            <i class="fa fa-toggle-on " title="Cuenta Responsable Activa"></i>
                            </a>';
                        }else{
                                echo '
                            <a class="cambiarEstatus btn btn-default" style="cursor:pointer" id="cambiarEstatus" name="cambiarEstatus">
                            <i class="fa fa-toggle-off " title="Cuenta Responsable Suspendida"></i>
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

<a href="#" class="registrarResponsable btn btn-dark fixed-bottom botonF1 ml-auto">+</a>

<div class="modal" id="modalConfirmacion" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">CAMBIAR ESTATUS DEL RESPONSABLE</h5>
            </div>
            <div class="modal-body">
                <div>
                    <label>Responsable:</label>
                    <label id="nombreResponsable" name="nombreResponsable"></label>
                </div>
                <div>
                    <label>Correo:</label>
                    <label id="correoResponsable" name="correoResponsable"></label>
                </div>
                <label id="textoConfirmacion" name="textoConfirmacion">¿Confirma que desea cambiar el estatus del
                    responsable? Sí el responsable cuenta con una sesión activa se
                    cerrará</label>
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
<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/ListaResponsables.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/jquery.dataTables.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/dataTables.bootstrap4.css" />
<script type="text/javascript" src="<?php echo base_url();?>js/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/jquery.dataTables.min.js"></script>