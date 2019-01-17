<div class="container-fluid">
        <h2 name="titulo" id="titulo">Modificar Alumno</h2>
        
        <form id="formularioAlumno" name="formularioAlumno" method="post">
            <div class="container col-md-5 border-0" align="center">
                <label for="matricula">Matrícula</label>
                <input type="text"  disabled class="form-control" id="matricula" name="matricula" value="<?php echo $matricula;?>" maxlength="9"
                        required>
            </div> 
            <div class="form-row">
            
                <div class="form-group col-md-5 border-0">
                    <label for="nombre">Nombre(s)</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre;?>" required>
                </div>
                <div class="form-group col-md-5 border-0">
                    <label for="apellidos">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" name="apellidos" value="<?php echo $apellidos;?>" required>
                </div>
                
                <div class="form-group col-md-5 border-0">
                    <label for="bloque">Bloque (Semestre)</label>
                    <select id="bloque" class="form-control" name="bloque" required>
                        <option value="">---------</option>
                        <?php 
                            for ($i=1; $i <= 13; $i++) { 
                                if($i == $bloque){
                                    echo "<option value='$i' selected>$i</option>";
                                }else{
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-5 border-0">
                    <label for="seccion">Sección (Turno)</label>
                    <select id="seccion" class="form-control" name="seccion" required>
                        <option value="">---------</option>
                        <?php 
                            for ($i=1; $i <= 3; $i++) { 
                                if($seccion == $i && $i == '1'){
                                    echo "<option value='$i' selected>$i (Mañana)</option>";
                                }elseif($seccion == $i && $i == '2'){
                                    echo "<option value='$i' selected>$i (Tarde)</option>";
                                }elseif($seccion == $i && $i == '3'){
                                    echo "<option value='$i' selected>$i (Sabatino)</option>";
                                }else{
                                    echo "<option value='$i'>$i</option>";
                                }
                            }
                        ?>
                    </select>
                </div>
                           
                <div class="form-group col-md-5 border-0">
                    <label for="correo">Correo Electrónico</label>
                    <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo;?>"
                        required>
                </div>
                <div class="form-group col-md-5 border-0">
                    <label for="telefono">Teléfono</label>
                    <input type="tel" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono;?>" required>
                </div>
            </div>
            <div class="row"> 
                <input type="button" class="btn btn-dark" id="cambiarContrasena" name="cambiarContrasena" value="CAMBIAR CONTRASEÑA">
                <input type="button" class="btn btn-dark" id="cambiarMatricula" name="cambiarMatricula" value="CAMBIAR MATRÍCULA">
                <input type="submit" class="btn btn-primary" value="GUARDAR CAMBIOS">
            </div>
        </form>
    </div>
    <div class="modal" id="modalConfirmacion" tabindex="-1" role="dialog" >
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">MODIFICAR ALUMNO</h5>
                    
                </div>
                <div class="modal-body">
                    <p>¿Confirma que desea modificar los datos del alumno?</p>
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

<script type="text/javascript" src="<?php echo base_url();?>js/coordinador/EditarAlumno.js"></script>