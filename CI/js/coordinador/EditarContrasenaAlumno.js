$(document).ready(function () {
    var base_url = window.location.origin;
    var contrasena1 = $('[name=contrasena1]');
    var contrasena2 = $('[name=contrasena2]');
    $("#formularioContrasena").validate({
		rules: {
            matricula: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9
            },
            contrasena1: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 6,
                maxlength: 15
            },
            contrasena2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                equalTo: "#contrasena1"
            }
        },    
		messages: {
            matricula: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            contrasena1: {
                required: "Dato requerido",
                minlength: "La contraseña debe tener entre 6 y 15 caracteres",
                maxlength: "La contraseña debe tener entre 6 y 15 caracteres"
            },
            contrasena2: {
                required: "Dato requerido",
                equalTo: "La contraseña no coincide"
            }
        },
        submitHandler: function(){
            $('#modalConfirmacion').modal('show');
        }
    });
    
    $("#botonCancelar").click(function(){
        $("#modalConfirmacion").modal('hide');
    });

    $("#botonEnviar").click(function(){
       
        var matricula = $("#matricula").val().trim();
        contrasena1 = $("#contrasena1").val().trim();  
        contrasena2 = $("#contrasena2").val().trim();    
		$.ajax({
			type: "POST",
			url: base_url + "/ServicioSocial/index.php/ModificarContrasenaAlumno",
			data: {
                'matricula': matricula,
                'contrasena1': contrasena1,
                'contrasena2': contrasena2
		},
		success: function(response){ 
           
            alert(response);  
            $("#modalConfirmacion").modal('hide');

            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }
            
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 

            if(response == 'matriculaInvalida'){
                $('<div class="alert alert-warning matriculaInvalida" role="alert">La matrícula es inválida</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".matriculaInvalida").fadeOut(1500);
                },10000);
            } 

            if(response == 'noExiste'){
                $('<div class="alert alert-warning noExiste" role="alert">El usuario no existe</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".noExiste").fadeOut(1500);
                },10000);
            }  
                       
            if(response == true){
                $(".errorAlGuardar").fadeOut(1500);
                $('<div class="alert alert-success guardadoExitoso" role="alert">Modificación Exitosa!!!</div>').insertAfter($("#matricula"));
                $("#contrasena1").val('');
                $("#contrasena2").val('');      
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".guardadoExitoso").fadeOut(2000);
                },10000);
            }

            if(response == false){
                $(".errorAlGuardar").fadeOut(1);
                $('<div class="alert alert-danger errorAlGuardar" role="alert">Error al intentar guardar los cambios</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".errorAlGuardar").fadeOut(1500);
                },10000);
            }
		}
		});
    });
 



//----MENSAJE CUANDO COINCIDEN LAS CONTRASEÑAS-----
  
    
    var spanContrasena2 = $('<span class="camposiguales">Coinciden</span>').insertAfter(contrasena2);
	spanContrasena2.hide();

    contrasena1.keyup(function () {
        $("#contrasena2").val('');   
        spanContrasena2.hide();
    });

	contrasena2.keyup(function () {
        var valor1 = contrasena1.val().trim();
        if(valor1.length >= 6 && valor1.length <=15){
            coincideContrasena();
        }else{
            spanContrasena2.hide();
        }     
    });

    function coincideContrasena() {
		var valor1 = contrasena1.val().trim();
		var valor2 = contrasena2.val().trim();
		if (valor1.length != 0 && valor1 == valor2) {     
			spanContrasena2.show();
		}else{
            spanContrasena2.hide();
        }
	}

//---------------------
});