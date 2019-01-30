$(document).ready(function () {
    var base_url = window.location.origin;
    var usuario = "";
    $("#formularioAlumno").validate({
		rules: {
            nombre: { 
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 60          
            },
            apellidos: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 60
            },
            matricula: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9
            },
            matricula2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9,
                equalTo: "#matricula"
            },
            bloque: { required:true},
            seccion: { required:true},
			correo: { required:true, email: true, maxlength: 320},
			telefono: { required:true, maxlength: 30 },
            contrasena: {
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
                minlength: 6,
                maxlength: 15,
                equalTo: "#contrasena"
            }
			
		},
		messages: {
            nombre: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 60 carácteres"
            },
            apellidos: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 60 carácteres"
            },    
            matricula: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            matricula2: {
                required: "Dato requerido",
                equalTo: "La matrícula no coincide",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            bloque: "Selecciona un bloque",
            seccion: "Selecciona una sección",
			correo : {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida",
                maxlength: "No debe exeder los 320 carácteres"
            },
			telefono : "Dato requerido",
			contrasena: {
                required: "Dato requerido",
                minlength: "La contraseña debe tener entre 6 y 15 caracteres",
                maxlength: "La contraseña debe tener entre 6 y 15 caracteres"
            },
            contrasena2: {
                required: "Dato requerido",
                minlength: "La contraseña debe tener entre 6 y 15 caracteres",
                maxlength: "La contraseña debe tener entre 6 y 15 caracteres",
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

    $("#botonEnviar").click(function(e){
        e.preventDefault();
        var nombre = $("#nombre").val().trim();
        var apellidos = $("#apellidos").val().trim();
        var matricula = $("#matricula").val().trim();
        var matricula2 = $("#matricula2").val().trim();
        var bloque = $("#bloque").val().trim();
        var seccion = $("#seccion").val().trim();
		var correo = $("#correo").val().trim();
		var telefono = $("#telefono").val().trim();
        var contrasena = $("#contrasena").val().trim();    
        var contrasena2 = $("#contrasena2").val().trim();
        var usuarioActual = document.title;
		$.ajax({
			type: "POST",
			url: base_url + "/ServicioSocial/index.php/RegistrarAlumno",
			data: {'nombre': nombre,
            'apellidos': apellidos,
            'matricula': matricula,
            'matricula2': matricula2,
            'bloque': bloque,
            'seccion': seccion,
			'correo': correo,
			'telefono': telefono,
            'contrasena': contrasena,
            'contrasena2': contrasena2,
            'usuarioActual': usuarioActual
		},
		success: function(response){   
            alert(response); 
            $("#modalConfirmacion").modal('hide');
			if(response == 'yaExiste'){
                $('<div class="alert alert-warning yaExiste" role="alert">Ya existe una cuenta con esa matrícula o dirección de correo</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".yaExiste").fadeOut(1500);
                },10000);
            }  
            
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 
            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }

            if(response == 'error'){
                $('<div class="alert alert-warning error" role="alert">Error al registrar su cuenta, intente de nuevo</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".error").fadeOut(1500);
                },10000);
            }
            
            if(response == 'coordinador'){
                usuario = 'coordinador';
                $("#modalExitoso").modal('show');
            }
            if(response == 'nuevo'){
                usuario = 'nuevo';
                $("#modalExitoso").modal('show');
            }
		}
		});
    });

    $("#botonCerrar").click(function(){
        if(usuario == 'coordinador'){
            window.location.href = base_url + "/ServicioSocial/index.php/Alumnos";
        }else{
            window.location.href = base_url + "/ServicioSocial/";
        }
        
    });

    $("#telefono").keypress(function(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });

    
    //----MENSAJE CUANDO COINCIDEN LAS MATRICULAS-----

    var matricula1 = $('[name=matricula]');
	var matricula2 = $('[name=matricula2]');
    
    var spanMatricula2 = $('<span class="camposiguales">Coinciden</span>').insertAfter(matricula2);
	spanMatricula2.hide();

    matricula1.keyup(function () {
        matricula2.val("");
        spanMatricula2.hide();
    });

	matricula2.keyup(function () {
        var valor1 = matricula1.val().trim();
        if(valor1.length == 9){
            coincideMatricula();
        }else{
            spanMatricula2.hide();
        }     
    });

    function coincideMatricula() {
		var valor1 = matricula1.val().trim();
		var valor2 = matricula2.val().trim();
		if (valor1.length != 0 && valor1 == valor2) {     
			spanMatricula2.show();
		}else{
            spanMatricula2.hide();
        }
	}
    
      //----MENSAJE CUANDO COINCIDEN LAS CONTRASEÑAS-----


      var contrasena = $('[name=contrasena]');
      var contrasena2 = $('[name=contrasena2]');
      
      var spanContrasena2 = $('<span class="camposiguales">Coinciden</span>').insertAfter(contrasena2);
      spanContrasena2.hide();
  
      contrasena.keyup(function () {
        contrasena2.val("");
          spanContrasena2.hide();
      });
  
      contrasena2.keyup(function () {
          var valor1 = contrasena.val().trim();
          if(valor1.length >= 6 || valor1.length <= 15){
              coincideContrasena();
          }else{
            spanContrasena2.hide();
          }     
      });
  
      function coincideContrasena() {
          var valor1 = contrasena.val().trim();
          var valor2 = contrasena2.val().trim();
          if (valor1.length != 0 && valor1 == valor2) {     
            spanContrasena2.show();
          }else{
            spanContrasena2.hide();
          }
      }

});



