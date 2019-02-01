<div class="container-fluid">
    <h2 name="titulo" id="titulo">Modificar Responsable</h2>
    
    <form id="formularioResponsable" name="formularioResponsable" method="post">
    <div class="container col-md-5 border-0" align="center">
                <label for="matricula">Correo Actual</label>
                <input type="text"  disabled class="form-control" id="correoActual" name="correoActual" value="<?php echo $correoResponsable;?>" maxlength="9"
                        required>
            </div> 
        <div class="row">
        <div class="col-md-10 border-0">
            <h5>Datos de la institución/dependencia</h5>
        </div>

            <div class="form-group col-md-5 border-0">
                <label for="nombreDependencia">Nombre de la Dependencia</label>
                <input type="text" class="form-control" id="nombreDependencia" name="nombreDependencia" value='<?php echo $nombreDependencia;?>'
                    required>
            </div>
            <div class="divSector form-group col-md-5 border-0">
                <label for="sectorDependencia">Sector</label>
                <select id="sectorDependencia" class="form-control" name="sectorDependencia" required>
                    <option id="sectorSeleccionado" value="<?php echo $sectorDependencia;?>">---------</option>
                    <option value="PÚBLICO">PÚBLICO</option>
                    <option value="PRIVADO">PRIVADO</option>

                </select>
            </div>
            <div class="form-group col-md-3 mb-2 border-0">
                <label for="telefonoDependencia">LADA + Teléfono</label>
                <input type="tel" class="form-control" id="telefonoDependencia" name="telefonoDependencia" value="<?php echo $telefonoDependencia;?>"
                    required>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="extDependencia">Ext.</label>
                <input type="tel" class="form-control" id="extDependencia" name="extDependencia" value="<?php echo $extensionDependencia;?>">
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="correoDependencia">Correo Electrónico</label>
                <input type="email" class="form-control" id="correoDependencia" name="correoDependencia" value="<?php echo $correoDependencia;?>"
                    required>
            </div>
            <div class="form-group col-md-3 mb-2 border-0">
                <label for="estadoRepublica">Estado</label>
                <select id="estadoRepublica" class="form-control" name="estadoRepublica" required>
                    <option id="estadoRepublicaSeleccionado" value="<?php echo $estadoRepublicaDependencia;?>">---------</option>
                    <option value="AGUASCALIENTES">AGUASCALIENTES</option>
                    <option value="BAJA CALIFORNIA">BAJA CALIFORNIA</option>
                    <option value="BAJA CALIFORNIA SUR">BAJA CALIFORNIA SUR</option>
                    <option value="CAMPECHE">CAMPECHE</option>
                    <option value="CHIAPAS">CHIAPAS</option>
                    <option value="CHIHUAHUA">CHIHUAHUA</option>
                    <option value="COAHUILA">COAHUILA</option>
                    <option value="COLIMA">COLIMA</option>
                    <option value="CDMX">CDMX</option>
                    <option value="DURANGO">DURANGO</option>
                    <option value="ESTADO DE MÉXICO">ESTADO DE MÉXICO</option>
                    <option value="GUANAJUATO">GUANAJUATO</option>
                    <option value="GUERRERO">GUERRERO</option>
                    <option value="HIDALGO">HIDALGO</option>
                    <option value="JALISCO">JALISCO</option>
                    <option value="MICHOACÁN">MICHOACÁN</option>
                    <option value="MORELOS">MORELOS</option>
                    <option value="NAYARIT">NAYARIT</option>
                    <option value="NUEVO LEÓN">NUEVO LEÓN</option>
                    <option value="OAXACA">OAXACA</option>
                    <option value="PUEBLA">PUEBLA</option>
                    <option value="QUERÉTARO">QUERÉTARO</option>
                    <option value="QUINTANA ROO">QUINTANA ROO</option>
                    <option value="SAN LUIS POTOSÍ">SAN LUIS POTOSÍ</option>
                    <option value="SINALOA">SINALOA</option>
                    <option value="SONORA">SONORA</option>
                    <option value="TABASCO">TABASCO</option>
                    <option value="TAMAULIPAS">TAMAULIPAS</option>
                    <option value="TLAXCALA">TLAXCALA</option>
                    <option value="VERACRUZ">VERACRUZ</option>
                    <option value="YUCATÁN">YUCATÁN</option>
                    <option value="ZACATECAS">ZACATECAS</option>
                </select>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="cpDependencia">C.P.</label>
                <input type="text" class="form-control" id="cpDependencia" name="cpDependencia" value="<?php echo $codigoPostalDependencia;?>" minlength="5" maxlength="5" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="ciudadDependencia">Ciudad</label>
                <input type="text" class="form-control" id="ciudadDependencia" name="ciudadDependencia" value="<?php echo $ciudadDependencia;?>"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="direccionDependencia">Dirección</label>
                <input type="text" class="form-control" id="direccionDependencia" name="direccionDependencia" value="<?php echo $direccionDependencia;?>"
                    required>
            </div>
            <div class="form-group col-md-3 border-0">
                <label for="numExterior">Núm. Exterior (0 = sin número)</label>
                <input type="text" class="form-control" id="numExterior" name="numExterior" value="<?php echo $numExteriorDependencia;?>" required>
            </div>
            <div class="form-group col-md-2 border-0">
                <label for="numInterior">Núm. Interior</label>
                <input type="text" class="form-control" id="numInterior" name="numInterior" value="<?php echo $numInteriorDependencia;?>">
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="usuariosDirectos">Usuarios Directos</label>
                <input type="text" class="form-control" id="usuariosDirectos" name="usuariosDirectos" value="<?php echo $usuariosDirectosDependencia;?>" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="usuariosIndirectos">Usuarios Indirectos</label>
                <input type="text" class="form-control" id="usuariosIndirectos" name="usuariosIndirectos" value="<?php echo $usuariosIndirectosDependencia;?>"
                    required>
            </div>
            <div class="form-group col-md-10 border-0">
                <h5>Datos del responsable a cargo de los proyectos:</h5>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="nombreResponsable">Nombre(s)</label>
                <input type="text" class="form-control" id="nombreResponsable" name="nombreResponsable" value="<?php echo $nombreResponsable;?>"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="apellidosResponsable">Apellidos</label>
                <input type="text" class="form-control" id="apellidosResponsable" name="apellidosResponsable" value="<?php echo $apellidosResponsable;?>"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="cargoResponsable">Cargo</label>
                <input type="text" class="form-control" id="cargoResponsable" name="cargoResponsable" value="<?php echo $cargoResponsable;?>" required>
            </div>
            <div class="form-group col-md-3 border-0">
                <label for="telefonoResponsable">LADA + Teléfono</label>
                <input type="tel" class="form-control" id="telefonoResponsable" name="telefonoResponsable" value="<?php echo $telefonoResponsable;?>"
                    required>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="extResponsable">Ext.</label>
                <input type="tel" class="form-control" id="extResponsable" name="extResponsable" value="<?php echo $extensionResponsable;?>">
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="correoResponsable1">Correo Electrónico</label>
                <input type="email" class="form-control" id="correoResponsable1" name="correoResponsable1" value="<?php echo $correoResponsable;?>"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="correoResponsable2">Confirmar Correo Electrónico</label>
                <input type="email" class="form-control" id="correoResponsable2" name="correoResponsable2" value="<?php echo $correoResponsable;?>"
                    required>
            </div>
        </div>
        <div class="row">
            <input type="submit" class="btn btn-primary registrar" value="GUARDAR CAMBIOS">
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
                <h5 class="modal-title">Cuenta Modificada Satisfactoriamente!!</h5>

            </div>
            <div class="modal-body">
                <p>Los datos han sido guardados correctamente </p>
            </div>
            <div class="modal-footer">
                <button type="button" name="botonCerrar" id="botonCerrar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/EditarResponsable.js"></script>