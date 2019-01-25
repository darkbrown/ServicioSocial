$(document).ready(function () {


    var base_url = window.location.origin;
    $('input#buscar').quicksearch('table tbody tr');

    $(".editar").click(function(e){
        e.preventDefault();
        var matricula = $(this).parents("tr").find('td:eq(2)').text().trim();
        matricula = encodeURIComponent(btoa(matricula));
        window.open(base_url + "/ServicioSocial/index.php/EditarAlumno/" + matricula);     
    });

    $(".ver").click(function(e){
        e.preventDefault();
        var matricula = $(this).parents("tr").find('td:eq(2)').text().trim();
        matricula = encodeURIComponent(btoa(matricula));
        window.open(base_url + "/ServicioSocial/index.php/ConsultarAlumno/" + matricula);     
    });

    $(".cambiarEstatus").click(function(e){
        e.preventDefault();
        var nombreAlumno = $(this).parents("tr").find('td:eq(1)').text().trim();
        var matricula = $(this).parents("tr").find('td:eq(2)').text().trim();
        var estatus = $('#cambiarEstatus').text();

        if(estatus == 'SUSPENDER'){
            $('#textoConfirmacion').html('¿Confirma que desea reactivar la cuenta del alumno?');
        }else{
            $('#textoConfirmacion').html('¿Confirma que desea suspender la cuenta del alumno? Si el alumno cuenta con una sesión activa se cerrará');
        }


        $('#nombreAlumno').html(nombreAlumno);
        $('#matriculaAlumno').html(matricula);     
        $("#modalConfirmacion").modal("show");
    });

    $("#botonCancelar").click(function(){
        $("#modalConfirmacion").modal('hide');
    });


    $("#botonConfirmar").click(function(e){

        var matricula = $('#matriculaAlumno').text();

        $.ajax({
            type: "POST",
            url: base_url + "/ServicioSocial/index.php/ModificarEstatusAlumno/",
            data: {
            'matricula': matricula
        },
        success: function(response){   
            alert(response);
            $("#modalConfirmacion").modal('hide'); 
            if(response == 'vacio'){
                $('<div class="alert alert-warning datosVacios" role="alert">Los datos no se recibieron correctamente, intenta de nuevo</div>').insertAfter($("#registrarAlumno"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosVacios").fadeOut(1500);
                },10000);
            }
            
            if(response == 'datosInvalidos'){
                $('<div class="alert alert-warning datosInvalidos" role="alert">Algunos datos son inválidos</div>').insertAfter($("#registrarAlumno"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".datosInvalidos").fadeOut(1500);
                },10000);
            } 

            if(response == 'matriculaInvalida'){
                $('<div class="alert alert-warning matriculaInvalida" role="alert">La matrícula es inválida</div>').insertAfter($("#registrarAlumno"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".matriculaInvalida").fadeOut(1500);
                },10000);
            } 

            if(response == 'noExiste'){
                $('<div class="alert alert-warning noExiste" role="alert">El usuario no existe</div>').insertAfter($("#registrarAlumno"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".noExiste").fadeOut(1500);
                },10000);
            }  
                       
            if(response == true){
                $("#modalExitoso").modal('show');
            }

            if(response == false){
                $(".errorAlGuardar").fadeOut(1);
                $('<div class="alert alert-danger errorAlGuardar" role="alert">Error al intentar guardar los cambios</div>').insertAfter($("#registrarAlumno"));
                $('body,html').animate({scrollTop : 0}, 500);
                setTimeout(function() {
                    $(".errorAlGuardar").fadeOut(1500);
                },10000);
            }
        }
        });
    });

    $("#botonCerrar").click(function(){
        $(".errorAlGuardar").fadeOut(1500);
        location.reload(true);
    });

});