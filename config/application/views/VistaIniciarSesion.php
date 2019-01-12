<!DOCTYPE html>
<html lang="es">

<head>
	<title>Servicio Social</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="<?php echo base_url();?>images/lis.ico" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/IniciarSesion/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>fonts/IniciarSesion/Linearicons-Free-v1.0.0/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/animate/animate.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/css-hamburgers/hamburgers.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>vendor/select2/select2.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/IniciarSesion/util.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/IniciarSesion/main.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/SolicitarRegistro/main.css">
	<script src="<?php echo base_url();?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>vendor/bootstrap/js/popper.js"></script>
	<script src="<?php echo base_url();?>vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>vendor/select2/select2.min.js"></script>
	<script src="<?php echo base_url();?>js/IniciarSesion.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>js/jquery.validate.js"></script>
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>images/IniciarSesion/img-02.jpg');">
			<div class="wrap-login100 p-t-10 p-b-30">
				<form class="login100-form" name="formularioInicio" id="formularioInicio" method="post">
					<span class="login100-form-title2">
						SERVICIO SOCIAL
					</span>
					<span class="login100-form-title p-t-20 p-b-45" id="titulo" name="titulo">
						LICENCIATURA EN INGENIERÍA DE SOFTWARE
					</span>


					<div class="input-group">
						<i class="fa fa-at input-group-addon"></i>
						<input class="form-control" type="email" id="correo" name="correo" value="prueba@gmail.com" placeholder="Correo Electrónico">
					</div>


					<div class="input-group">
						<i class="fa fa-lock input-group-addon"></i>
						<input class="form-control" type="password" id="contrasena" name="contrasena" value="123456" placeholder="Contraseña">
					</div>
					<div class="text-right w-full p-t-5 p-b-5">
						<a href="#" class="txt1">
							Recuperar Contraseña
						</a>
					</div>

					<div class="container-login100-form-btn p-t-10">
						<button class="login100-form-btn">
							INGRESAR
						</button>
					</div>
					<div class="text-center w-full p-t-20">
						<a class="txt1" href="<?php echo base_url()?>index.php/tipoCuenta">
							Solicitar Registro
							<i class="fa fa-long-arrow-right"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal" id="modalNoExitoso" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog " role="document">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title tituloNoExitoso">Cuenta Creada Satisfactoriamente!!</h5>
                    
                </div>
                <div class="modal-body">
                    <p class="contenidoNoExitoso">Tu cuenta ha sido creada correctamente</p>
                </div>
                <div class="modal-footer">
                    <button type="button" name="botonCerrar" id="botonCerrar" class="btn btn-secondary" data-dismiss="modal">CERRAR</button>
                </div>
            </div>
        </div>
    </div>

</body>

</html>