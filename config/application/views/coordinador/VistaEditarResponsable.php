<div class="container-fluid">
    <h2 name="titulo" id="titulo">Modificar Responsable</h2>
    <div class="row">
        <div class="col-md-10 border-0">
            <h5>Datos de la institución/dependencia</h5>
        </div>
    </div>
    <form id="formularioDependencia" name="formularioDependencia" method="post">
        <div class="form-row">
            <div class="form-group col-md-5 border-0">
                <label for="nombreDependencia">Nombre de la Dependencia</label>
                <input type="text" class="form-control" id="nombreDependencia" name="nombreDependencia" value="mi dependencia"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="sectorDependencia">Sector</label>
                <select id="sectorDependencia" class="form-control" name="sectorDependencia" required>
                    <option value="">---------</option>
                    <option value="público" selected>Público</option>
                    <option value="privado">Privado</option>
                </select>
            </div>
            <div class="form-group col-md-3 mb-2 border-0">
                <label for="telefonoDependencia">LADA + Teléfono</label>
                <input type="tel" class="form-control" id="telefonoDependencia" name="telefonoDependencia" value="1010101454"
                    required>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="extDependencia">Ext.</label>
                <input type="tel" class="form-control" id="extDependencia" name="extDependencia" value="156">
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="correoDependencia">Correo Electrónico</label>
                <input type="email" class="form-control" id="correoDependencia" name="correoDependencia" value="dependencia@gmail.com"
                    required>
            </div>
            <div class="form-group col-md-3 mb-2 border-0">
                <label for="estadoRepublica">Estado</label>
                <select id="estadoRepublica" class="form-control" name="estadoRepublica" required>
                    <option value="">---------</option>
                    <option value="Aguascalientes">Aguascalientes</option>
                    <option value="Baja California">Baja California</option>
                    <option value="Baja California Sur">Baja California Sur</option>
                    <option value="Campeche">Campeche</option>
                    <option value="Chiapas">Chiapas</option>
                    <option value="Chihuahua">Chihuahua</option>
                    <option value="Coahuila">Coahuila</option>
                    <option value="Colima" selected>Colima</option>
                    <option value="Distrito Federal">Distrito Federal</option>
                    <option value="Durango">Durango</option>
                    <option value="Estado de México">Estado de México</option>
                    <option value="Guanajuato">Guanajuato</option>
                    <option value="Guerrero">Guerrero</option>
                    <option value="Hidalgo">Hidalgo</option>
                    <option value="Jalisco">Jalisco</option>
                    <option value="Michoacán">Michoacán</option>
                    <option value="Morelos">Morelos</option>
                    <option value="Nayarit">Nayarit</option>
                    <option value="Nuevo León">Nuevo León</option>
                    <option value="Oaxaca">Oaxaca</option>
                    <option value="Puebla">Puebla</option>
                    <option value="Querétaro">Querétaro</option>
                    <option value="Quintana Roo">Quintana Roo</option>
                    <option value="San Luis Potosí">San Luis Potosí</option>
                    <option value="Sinaloa">Sinaloa</option>
                    <option value="Sonora">Sonora</option>
                    <option value="Tabasco">Tabasco</option>
                    <option value="Tamaulipas">Tamaulipas</option>
                    <option value="Tlaxcala">Tlaxcala</option>
                    <option value="Veracruz">Veracruz</option>
                    <option value="Yucatán">Yucatán</option>
                    <option value="Zacatecas">Zacatecas</option>
                </select>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="cpDependencia">C.P.</label>
                <input type="text" class="form-control" id="cpDependencia" name="cpDependencia" value="12345" minlength="5" maxlength="5" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="ciudadDependencia">Ciudad</label>
                <input type="text" class="form-control" id="ciudadDependencia" name="ciudadDependencia" value="xalapa"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="direccionDependencia">Dirección</label>
                <input type="text" class="form-control" id="direccionDependencia" name="direccionDependencia" value="Av. miradores"
                    required>
            </div>
            <div class="form-group col-md-3 border-0">
                <label for="numExterior">Núm. Exterior (0 = sin número)</label>
                <input type="text" class="form-control" id="numExterior" name="numExterior" value="5" required>
            </div>
            <div class="form-group col-md-2 border-0">
                <label for="numInterior">Núm. Interior</label>
                <input type="text" class="form-control" id="numInterior" name="numInterior" value="20">
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="usuariosDirectos">Usuarios Directos</label>
                <input type="text" class="form-control" id="usuariosDirectos" name="usuariosDirectos" value="1500" required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="usuariosIndirectos">Usuarios Indirectos</label>
                <input type="text" class="form-control" id="usuariosIndirectos" name="usuariosIndirectos" value="2000"
                    required>
            </div>
            <div class="form-group col-md-10 border-0">
                <h5>Datos del responsable a cargo de los proyectos:</h5>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="nombreResponsable">Nombre(s)</label>
                <input type="text" class="form-control" id="nombreResponsable" name="nombreResponsable" value="miguel"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="apellidosResponsable">Apellidos</label>
                <input type="text" class="form-control" id="apellidosResponsable" name="apellidosResponsable" value="hidalgo"
                    required>
            </div>
            <div class="form-group col-md-5 border-0">
                <label for="cargoResponsable">Cargo</label>
                <input type="text" class="form-control" id="cargoResponsable" name="cargoResponsable" value="el mero jefe" required>
            </div>
            <div class="form-group col-md-3 border-0">
                <label for="telefonoResponsable">LADA + Teléfono</label>
                <input type="tel" class="form-control" id="telefonoResponsable" name="telefonoResponsable" value="5646546"
                    required>
            </div>
            <div class="form-group col-md-2 mb-2 border-0">
                <label for="extResponsable">Ext.</label>
                <input type="tel" class="form-control" id="extResponsable" name="extResponsable" value="">
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

<script type="text/javascript" src="<?php echo base_url();?>js/EditarResponsable.js"></script>