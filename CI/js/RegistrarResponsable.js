$(document).ready(function () {
    var base_url = window.location.origin;
    var usuario = "";
    $("#telefonoDependencia, #extDependencia, #cpDependencia, #numExterior, #numInterior, #usuariosDirectos, #usuariosIndirectos, #telefonoResponsable, #extResponsable").keypress(function(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });

    $("#formularioDependencia").validate({
		rules: {
            nombreDependencia: { 
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 350          
            },
            sectorDependencia: { required:true},
            telefonoDependencia: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 30
            },
            extDependencia: {
                normalizer: function (value) {
                    return $.trim(value);
                }, 
                maxlength: 30
            },
            correoDependencia: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                email: true,
                maxlength: 320
            },
            estadoRepublica: { required:true},
            cpDependencia: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 5,
                maxlength: 5
            },
            ciudadDependencia: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 100
            },
            direccionDependencia: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 200
            },
            numExterior: { 
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 20
            },
            numInterior: { 
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 20
            },
            usuariosDirectos: { 
                required:true,
                maxlength: 20
            },
            usuariosIndirectos: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 20
            },           
            nombreResponsable: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 60
            },
            apellidosResponsable: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 60
            },
            cargoResponsable: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 120
            },
            telefonoResponsable: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                maxlength: 30
            },
            extResponsable: {
                normalizer: function (value) {
                    return $.trim(value);
                }, 
                maxlength: 30
            },
            correoResponsable1: { 
                required:true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                email: true,
                maxlength: 320
            },
            correoResponsable2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                email: true,
                equalTo: "#correoResponsable1"
            },
            contrasenaResponsable1: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }, 
                minlength: 6,
                maxlength: 15
            },
            contrasenaResponsable2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 6,
                maxlength: 15,
                equalTo: "#contrasenaResponsable1"
            }
        },           
        messages: {
            nombreDependencia: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 350 carácteres"
            },
            sectorDependencia: {
                required: "Dato requerido"
            },
            telefonoDependencia: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 30 carácteres"
            },
            extDependencia: {
                maxlength: "No debe exeder los 30 carácteres"
            },
            correoDependencia: {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida",
                maxlength: "No debe exeder los 350 carácteres"
            },
            estadoRepublica:{
                required: "Dato requerido"
            },
            cpDependencia: {
                required: "Dato requerido",
                minlength: "El C.P. debe tener 5 números",
                maxlength: "El C.P. debe tener 5 números"
            }, 
            ciudadDependencia: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 100 carácteres"
            },
            direccionDependencia: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 200 carácteres"
            },
            numExterior: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 20 carácteres"
            },
            numInterior: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 20 carácteres"
            },
            usuariosDirectos: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 20 carácteres"
            },
            usuariosIndirectos: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 20 carácteres"
            },
            nombreResponsable: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 60 carácteres"
            },
            apellidosResponsable: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 60 carácteres"
            },
            cargoResponsable: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 120 carácteres"
            },
            telefonoResponsable: {
                required: "Dato requerido",
                maxlength: "No debe exeder los 30 carácteres"
            },
            extResponsable: {
                maxlength: "No debe exeder los 30 carácteres"
            },
            correoResponsable1: {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida",
                maxlength: "No debe exeder los 320 carácteres"
            },
            correoResponsable2: {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida",
                equalTo: "Los correos no coinciden"
            },
            contrasenaResponsable1: {
                required: "Dato requerido",
                minlength: "La contraseña debe tener entre 6 y 15 caracteres",
                maxlength: "La contraseña debe tener entre 6 y 15 caracteres"
            },
            contrasenaResponsable2: {
                required: "Dato requerido",
                minlength: "La contraseña debe tener entre 6 y 15 caracteres",
                maxlength: "La contraseña debe tener entre 6 y 15 caracteres",
                equalTo: "Las contraseñas no coinciden"
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
        var nombreDependencia = $("#nombreDependencia").val().trim();
        var sectorDependencia = $("#sectorDependencia").val().trim();
        var telefonoDependencia = $("#telefonoDependencia").val().trim();
        var extDependencia = $("#extDependencia").val().trim();
        var correoDependencia = $("#correoDependencia").val().trim();
        var estadoRepublica = $("#estadoRepublica").val().trim();
		var cpDependencia = $("#cpDependencia").val().trim();
		var ciudadDependencia = $("#ciudadDependencia").val().trim();
        var direccionDependencia = $("#direccionDependencia").val().trim();    
        var numExterior = $("#numExterior").val().trim();
        var numInterior = $("#numInterior").val().trim();    
        var usuariosDirectos = $("#usuariosDirectos").val().trim();    
        var usuariosIndirectos = $("#usuariosIndirectos").val().trim();        
        var nombreResponsable = $("#nombreResponsable").val().trim();    
        var apellidosResponsable = $("#apellidosResponsable").val().trim();    
        var cargoResponsable = $("#cargoResponsable").val().trim();    
        var telefonoResponsable = $("#telefonoResponsable").val().trim();    
        var extResponsable = $("#extResponsable").val().trim(); 
        var correoResponsable1 = $("#correoResponsable1").val().trim();    
        var correoResponsable2 = $("#correoResponsable2").val().trim();    
        var contrasenaResponsable1 = $("#contrasenaResponsable1").val().trim();    
        var contrasenaResponsable2 = $("#contrasenaResponsable2").val().trim();     
        var usuarioActual = document.title;  
		$.ajax({
			type: "POST",
			url: base_url + "/ServicioSocial/index.php/RegistrarResponsable",
			data: {
                'nombreDependencia': nombreDependencia,
                'sectorDependencia': sectorDependencia,
                'telefonoDependencia': telefonoDependencia,
                'extDependencia': extDependencia,
                'correoDependencia': correoDependencia,
                'estadoRepublica': estadoRepublica,
                'cpDependencia': cpDependencia,
                'ciudadDependencia': ciudadDependencia,
                'direccionDependencia': direccionDependencia,
                'numExterior': numExterior,
                'numInterior': numInterior,
                'usuariosDirectos': usuariosDirectos,
                'usuariosIndirectos': usuariosIndirectos,
                'nombreResponsable': nombreResponsable,
                'apellidosResponsable': apellidosResponsable,
                'cargoResponsable': cargoResponsable,
                'telefonoResponsable': telefonoResponsable,
                'extResponsable': extResponsable,
                'correoResponsable1': correoResponsable1,
                'correoResponsable2': correoResponsable2,
                'contrasenaResponsable1': contrasenaResponsable1,
                'contrasenaResponsable2': contrasenaResponsable2,
                'usuarioActual': usuarioActual
		    },
		success: function(response){   
            alert(response); 
            $("#modalConfirmacion").modal('hide');
            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 
			if(response == 'yaExiste'){
                $('<div class="alert alert-warning yaExiste" role="alert">Ya existe un responsable con el mismo correo</div>').insertAfter($("#titulo"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".yaExiste").fadeOut(1500);
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
            window.location.href = base_url + "/ServicioSocial/index.php/Responsables";
        }else{
            window.location.href = base_url + "/ServicioSocial/";
        }
    });

        
    //----MENSAJE CUANDO COINCIDEN LOS CORREOS DEL RESPONSABLE-----

    var correo1 = $('[name=correoResponsable1]');
	var correo2 = $('[name=correoResponsable2]');
    
    var spanCorreo2 = $('<span class="camposiguales">Coinciden</span>').insertAfter(correo2);
	spanCorreo2.hide();

    correo1.keyup(function () {
        correo2.val("");
        spanCorreo2.hide();
    });

	correo2.keyup(function () {
        spanCorreo2.hide();
        coincideCorreo();
    });

    function coincideCorreo() {
		var valor1 = correo1.val().trim();
		var valor2 = correo2.val().trim();
		if (valor1.length != 0 && valor1 == valor2) {     
			spanCorreo2.show();
		}else{
            spanCorreo2.hide();
        }
	}
    
      //----MENSAJE CUANDO COINCIDEN LAS CONTRASEÑAS-----


      var contrasena = $('[name=contrasenaResponsable1]');
      var contrasena2 = $('[name=contrasenaResponsable2]');
      
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



