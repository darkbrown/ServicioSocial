
$(document).ready(function () {
    var base_url = window.location.origin;
    $("#formularioInicio").validate({
		rules: {
			correo: { required:true, email: true},
            contrasena: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            }			
		},
		messages: {
			correo : {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida"
            },
			contrasena: {
                required: "Dato requerido"
            }
        },
        submitHandler: function(){
            var correo = $("#correo").val();
            var contrasena = $("#contrasena").val();      
            $.ajax({
                type: "POST",
                url: base_url + "/ServicioSocial/index.php/iniciarSesion",
                data: {
                'correo': correo,
                'contrasena': contrasena
            },
            success: function(response){    
                if(response == 'vacio'){
                    $(".datosVacios").fadeOut(1);
                    $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#titulo"));
                    $('body,html').animate({scrollTop : 0}, 500);
                    setTimeout(function() {
                        $(".datosVacios").fadeOut(1500);
                    },10000);
                }

                if(response == 'datosInvalidos'){
                    $(".datosInvalidos").fadeOut(1);
                    $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#titulo"));
                    $('body,html').animate({scrollTop : 0}, 500);
                    setTimeout(function() {
                        $(".datosInvalidos").fadeOut(1500);
                    },10000);
                } 

                if(response == 'noExiste'){
                    $(".noExiste").fadeOut(1);
                    $('<div class="alert alert-warning noExiste" role="alert">La dirección de correo o contraseña no son válidas</div>').insertAfter($("#titulo"));
                    $('body,html').animate({scrollTop : 0}, 500);
                    setTimeout(function() {
                        $(".noExiste").fadeOut(1500);
                    },10000);
                } 
                
                if(response == 'suspendido'){
                    $(".suspendido").fadeOut(1);
                    $('<div class="alert alert-danger suspendido" role="alert">Por el momento su cuenta se encuentra suspendida, contacte al coordinador</div>').insertAfter($("#titulo"));
                    $('body,html').animate({scrollTop : 0}, 500);
                    setTimeout(function() {
                        $(".suspendido").fadeOut(1500);
                    },10000);
                } 

                if(response == 'exitosa'){
                    window.location.href = base_url + "/ServicioSocial/index.php/inicioAlumno"; 
                } 
                
            }
            });
            
        }
    });

});