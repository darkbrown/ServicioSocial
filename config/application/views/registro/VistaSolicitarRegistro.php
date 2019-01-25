<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/SolicitarRegistro/main.css">
    <title>Registrar</title>
</head>

<body>
  
    <div class="container-fluid">
    <h2 >Selecciona un Tipo de Cuenta</h2>
        <div class="row">
            <div class="card-deck">
                <div class="card">
                    <img class="card-img-top" href="<?php echo base_url();?>" src="<?php echo base_url();?>images/SolicitarRegistro/estudiantes.jpg"
                        alt="Imagen de estudiantes">
                    <div class="card-block">
                        <h4 class="card-title">Cuenta Alumno</h4>
                        <div class="row">
                            <div class="col-7 bg-white border-white">
                                <p class="card-text">Solo para estudiantes de la LIS</p>
                            </div>
                            <div class="col-4 bg-white border-white">
                                <a href="<?php echo base_url()?>index.php/FormularioAlumno" class="btn btn-primary">REGISTRAR</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <img class="card-img-top" src="<?php echo base_url();?>images/SolicitarRegistro/dependencia.jpg"
                        alt="Imagen de ejecutivo dependencia">
                    <div class="card-block">
                        <h4 class="card-title">Cuenta Dependencia</h4>
                        <div class="row">
                            <div class="col-7 bg-white border-white">
                                <p class="card-text">¿Quieres solicitar alumnos de Ingeniería de Software en tu
                                    dependencia y/o
                                    enviar tus proyectos?</p>
                            </div>
                            <div class="col-4 bg-white border-white">
                                <a href="<?php echo base_url()?>index.php/FormularioDependencia" class="btn btn-primary">REGISTRAR</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>