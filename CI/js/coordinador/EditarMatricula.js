$(document).ready(function () {
    var base_url = window.location.origin;
    $("#formularioMatricula").validate({
		rules: {
            matriculaAnterior: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9
            },
            matriculaNueva: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                minlength: 9,
                maxlength: 9
            },
            matriculaNueva2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                equalTo: "#matriculaNueva"
            }
        },    
		messages: {
            matriculaAnterior: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            matriculaNueva: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            matriculaNueva2: {
                required: "Dato requerido",
                equalTo: "La matrícula no coincide"
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
       
        var matriculaAnterior = $("#matriculaAnterior").val().trim();
        var matriculaNueva = $("#matriculaNueva").val().trim();  
        var matriculaNueva2 = $("#matriculaNueva2").val().trim();    
		$.ajax({
			type: "POST",
			url: base_url + "/ServicioSocial/index.php/ModificarMatricula",
			data: {
                'matriculaAnterior': matriculaAnterior,
                'matriculaNueva': matriculaNueva,
                'matriculaNueva2': matriculaNueva2
		},
		success: function(response){ 
           
            alert(response);  
            $("#modalConfirmacion").modal('hide');
            
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#matriculaAnterior"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 

            if(response == 'yaExiste'){
                $('<div class="alert alert-warning yaExiste" role="alert">Ya existe una cuenta con esa matrícula</div>').insertAfter($("#matriculaAnterior"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".yaExiste").fadeOut(1500);
                },10000);
            }  
            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#matriculaAnterior"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }

            if(response == 'sonIguales'){
                $('<div class="alert alert-warning sonIguales" role="alert">La matrícula nueva es la misma que la actual</div>').insertAfter($("#matriculaAnterior"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".sonIguales").fadeOut(1500);
                },10000);
            } 

           
            if(response == true){
                $("#modalExitoso").modal('show');
            }

            if(response == false){
                $(".errorAlGuardar").fadeOut(1);
                $('<div class="alert alert-danger errorAlGuardar" role="alert">Error al intentar guardar los cambios o no ha realizado modificaciones</div>').insertAfter($("#matriculaAnterior"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".errorAlGuardar").fadeOut(1500);
                },10000);
            }
		}
		});
    });
    var matricula1 = $('[name=matriculaNueva]');
    var matricula2 = $('[name=matriculaNueva2]');
    var matricula0 = $('[name=matriculaAnterior]');

    $("#botonCerrar").click(function(){
        $(".errorAlGuardar").fadeOut(1500);
            $('<div class="alert alert-success guardadoExitoso" role="alert">Modificación Exitosa!!!</div>').insertAfter($("#matriculaAnterior"));
            matricula0.val(matricula1.val().toUpperCase().trim());
            matricula1.val("");
            matricula2.val("");            
            $('body,html').animate({scrollTop : 0}, 500);
            setTimeout(function() {
                $(".guardadoExitoso").fadeOut(2000);
            },10000);
    });


//----MENSAJE CUANDO COINCIDEN LAS MATRICULAS-----
  
    
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

//---------------------
});