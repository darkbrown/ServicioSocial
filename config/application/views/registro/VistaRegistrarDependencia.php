<div class="container-fluid">
    <h2 name="titulo" id="titulo">Registrar Dependencia</h2>
    <div class="row">
        <div class="form-group col-md-10 border-0">
            <h5>Datos de la institución/dependencia a la que perteneces:</h5>
            <p>Favor de llenar los campos correctamente, una vez registrados no podrá cambiarlos por su cuenta. Será
                necesario ponerse en contacto con el coordinador de servicio socia</p>
        </div>
    </div>
    <form id="formularioAlumno" name="formularioAlumno" method="post">
        <div class="form-row">
            <div class="form-group col-md-5 border-0">
                <label for="nombre">Nombre(s)</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="CRISTIAN" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="apellidos">Apellidos</label>
                <input type="text" class="form-control" id="apellidos" name="apellidos" value="MENDOZA" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="matricula">Matrícula</label>
                <input type="text" class="form-control" id="matricula" name="matricula" value="S14011620" maxlength="9"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="matricula2">Confirmar Matrícula</label>
                <input type="text" class="form-control" id="matricula2" name="matricula2" value="S14011620" maxlength="9"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="bloque">Bloque (Semestre)</label>
                <select id="bloque" class="form-control" name="bloque" required>
                    <option value="">---------</option>
                    <option value="1" selected>1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                    <option value="9">9</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                </select>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="seccion">Sección (Turno)</label>
                <select id="seccion" class="form-control" name="seccion" required>
                    <option value="">---------</option>
                    <option value="1">1 (Mañana)</option>
                    <option value="2" selected>2 (Tarde)</option>
                    <option value="3">3 (Sabatino)</option>
                </select>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="correo">Correo Electrónico</label>
                <input type="email" class="form-control" id="correo" name="correo" value="prueba@gmail.com" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="telefono">Teléfono</label>
                <input type="tel" class="form-control" id="telefono" name="telefono" value="454654512" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" name="contrasena" id="contrasena" minlength="6" maxlength="15"
                    value="123456" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="contrasena2">Confirmar Contraseña</label>
                <input type="password" class="form-control" id="contrasena2" name="contrasena2" minlength="6" maxlength="15"
                    value="123456" required>
            </div>
        </div>
        <div class="row">
            <input type="submit" class="btn btn-primary registrar" value="REGISTRAR">
        </div>
    </form>
</div>
<div class="modal" id="modalConfirmacion" tabindex="-1" role="dialog">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Cuenta</h5>

            </div>
            <div class="modal-body">
                <p>Confirmar envio del formulario</p>
            </div>
            <div class="modal-footer">
                <button type="submit" name="botonEnviar" id="botonEnviar" class="btn btn-primary">ENVIAR</button>
                <button type="button" name="botonCancelar" id="botonCancelar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modalExitoso" tabindex="-1" role="dialog" data-backdrop="static">
    <div class="modal-dialog " role="document">
        <div class="modal-content ">
            <div class="modal-header">
                <h5 class="modal-title">Cuenta Creada Satisfactoriamente!!</h5>

            </div>
            <div class="modal-body">
                <p>Tu cuenta ha sido creada correctamente</p>
            </div>
            <div class="modal-footer">
                <button type="button" name="botonCerrar" id="botonCerrar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script type="text/javascript" src="<?php echo base_url();?>js/RegistrarDependencia.js"></script>
