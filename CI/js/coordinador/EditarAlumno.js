$(document).ready(function () {
    var base_url = window.location.origin;
    $("#formularioAlumno").validate({
		rules: {
            nombre: { 
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }          
            },
            apellidos: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                }
            },
            matricula: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9
            },
            bloque: { required:true},
            seccion: { required:true},
			correo: { required:true, email: true},
			telefono: { required:true},
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
                equalTo: "#contrasena"
            }
			
		},
		messages: {
            nombre: {
                required: "Dato requerido"
            },
            apellidos: "Dato requerido",
            matricula: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            bloque: "Selecciona un bloque",
            seccion: "Selecciona una sección",
			correo : {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo válida"
            },
			telefono : "Dato requerido"
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
        var bloque = $("#bloque").val().trim();
        var seccion = $("#seccion").val().trim();
		var correo = $("#correo").val().trim();
        var telefono = $("#telefono").val().trim(); 
        var matricula = $("#matricula").val().trim();  
		$.ajax({
			type: "POST",
			url: base_url + "/ServicioSocial/index.php/ModificarAlumno",
			data: {'nombre': nombre,
            'apellidos': apellidos,
            'bloque': bloque,
            'seccion': seccion,
			'correo': correo,
            'telefono': telefono,
            'matricula': matricula
		},
		success: function(response){  
            alert(response); 
            $("#modalConfirmacion").modal('hide');
            
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 
            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }
            
            if(response == 'matriculaInvalida'){
                $('<div class="alert alert-warning matriculaInvalida" role="alert">No se encontro una matrícula</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".matriculaInvalida").fadeOut(1500);
                },10000);
            } 

            if(response == 'yaExisteCorreo'){
                $('<div class="alert alert-warning yaExisteCorreo" role="alert">Ya existe una cuenta con ese correo electrónico</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".yaExisteCorreo").fadeOut(1500);
                },10000);
            } 

            if(response == true){
                $("#modalExitoso").modal('show');
            }
            if(response == 'errorCorreo'){
                $(".errorCorreo").fadeOut(1500);
                $('<div class="alert alert-danger errorCorreo" role="alert">Error al modificar el correo</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".errorCorreo").fadeOut(1500);
                },10000);
            }

            if(response == false){
                $(".errorAlGuardar").fadeOut(1500);
                $('<div class="alert alert-warning errorAlGuardar" role="alert">No ha modificado ningún dato</div>').insertAfter($("#matricula"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".errorAlGuardar").fadeOut(1500);
                },10000);
            }
		}
		});
    });

    $("#botonCerrar").click(function(){
        location.reload(true);
    });

    $("#telefono").keypress(function(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });

    $("#cambiarMatricula").click(function(){
        var matricula = $('#matricula').val().trim();
        matricula = encodeURIComponent(btoa(matricula));
        window.location.href = base_url + "/ServicioSocial/index.php/CambiarMatricula/" + matricula;    
    });

    $("#cambiarContrasena").click(function(){
        var matricula = $('#matricula').val().trim();
        var nombre = $('#nombre').val().trim();
        var apellidos = $('#apellidos').val().trim();
       // matricula = encodeURIComponent(btoa(matricula));

       $.ajax({
        type: "POST",
        url: base_url + "/ServicioSocial/index.php/ModificarContrasenaAlumno",
        data: {'matricula': matricula,
        'nombre': nombre,
        'apellidos': apellidos
        },
         success: function(response){
            alert(response);
            $(response);
         }
	    });     
    });

});