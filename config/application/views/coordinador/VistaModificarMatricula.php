<div class="container-fluid">
    <h2 name="titulo" id="titulo">Modificar Matrícula</h2>

    <form id="formularioMatricula" name="formularioMatricula" method="post">
        <div class="container col-md-5 border-0" align="center">
            <label for="matriculaAnterior">Matrícula Actual</label>
            <input type="text" disabled class="form-control" id="matriculaAnterior" name="matriculaAnterior" value="<?php echo $matricula;?>"
                maxlength="9" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-5 border-0">
                <label for="matriculaNueva">Nueva Matrícula</label>
                <input type="text" class="form-control" id="matriculaNueva" name="matriculaNueva" maxlength="9" value=""
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="matriculaNueva2">Confirmar Nueva Matrícula</label>
                <input type="text" class="form-control" id="matriculaNueva2" name="matriculaNueva2" maxlength="9" value=""
                    required>
            </div>

        </div>
        <div class="row">
            <input type="submit" class="btn btn-primary" value="GUARDAR">
        </div>
    </form>
</div>
<div class="modal" id="modalConfirmacion" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">MODIFICAR MATRÍCULA</h5>

            </div>
            <div class="modal-body">
                <p>¿Confirma que desea modificar la matrícula del alumno?</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="botonEnviar" id="botonEnviar" class="btn btn-primary">CONFIRMAR</button>
                <button type="button" name="botonCancelar" id="botonCancelar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalExitoso" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Datos Guardados Satisfactoriamente!!</h5>

            </div>
            <div class="modal-body">
                <p>Los datos han sido guardados correctamente</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="botonCerrar" id="botonCerrar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/EditarMatricula.js"></script>