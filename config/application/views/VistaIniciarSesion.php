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
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="vendor/select2/select2.min.js"></script>
	<script src="js/IniciarSesion/main.js"></script>
</head>

<body>

	<div class="limiter">
		<div class="container-login100" style="background-image: url('<?php echo base_url();?>images/IniciarSesion/img-02.jpg');">
			<div class="wrap-login100 p-t-10 p-b-30">
				<form class="login100-form validate-form" method="post">
					<span class="login100-form-title2">
						SERVICIO SOCIAL
					</span>
					<span class="login100-form-title p-t-20 p-b-45">
						LICENCIATURA EN INGENIERÍA DE SOFTWARE
					</span>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Correo Electrónico Requerido">
						<input class="input100" type="email" name="correo" placeholder="Correo Electrónico">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-at"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input m-b-10" data-validate="Contraseña Requerida">
						<input class="input100" type="password" name="contrasena" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock"></i>
						</span>
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
						<a class="txt1" href="<?php echo base_url()?>index.php/ControladorSolicitarRegistro/index">
							Solicitar Registro
							<i class="fa fa-long-arrow-right"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


</body>

</html>