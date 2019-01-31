$(document).ready(function () {
    var base_url = window.location.origin;
   
    var table = $('#tablaResponsables').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "aaSorting": []
    });

    $(".registrarResponsable").click(function(){
        location.href = base_url + "/ServicioSocial/index.php/FormularioResponsable/coordinador";
    });

    $('#tablaResponsables tbody').on( 'click', '.editar', function () {
        var datosFila = table.row( $(this).parents('tr') ).data();
        correo = encodeURIComponent(btoa(datosFila[2]));
        window.open(base_url + "/ServicioSocial/index.php/EditarResponsable/" + correo); 
    } );



/**Por revisar */
    

    $('#tablaResponsables tbody').on( 'click', '.ver', function () {
        var datosFila = table.row( $(this).parents('tr') ).data();
        matricula = encodeURIComponent(btoa(datosFila[1]));
        window.open(base_url + "/ServicioSocial/index.php/ConsultarAlumno/" + matricula); 
    } );

    $('#tablaResponsables tbody').on( 'click', '.cambiarEstatus', function () {
        var datosFila = table.row( $(this).parents('tr') ).data();
        
        if ($(this).children('i').hasClass('fa-toggle-on')){
            $('#textoConfirmacion').html('¿Confirma que desea suspender la cuenta del alumno? Sí el alumno cuenta con una sesión activa se cerrará');
        }else{
            $('#textoConfirmacion').html('¿Confirma que desea reactivar la cuenta del alumno?');
        }

        $('#nombreAlumno').html(datosFila[0]);
        $('#matriculaAlumno').html(datosFila[1]);     
        $("#modalConfirmacion").modal("show");
    } );


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


    


    jQuery.fn.DataTable.ext.type.search.string = function ( data ) {
        return ! data ?
            '' :
            typeof data === 'string' ?
                data
                    .replace( /έ/g, 'ε')
                    .replace( /ύ/g, 'υ')
                    .replace( /ό/g, 'ο')
                    .replace( /ώ/g, 'ω')
                    .replace( /ά/g, 'α')
                    .replace( /ί/g, 'ι')
                    .replace( /ή/g, 'η')
                    .replace( /\n/g, ' ' )
                    .replace( /[áÁ]/g, 'a' )
                    .replace( /[éÉ]/g, 'e' )
                    .replace( /[íÍ]/g, 'i' )
                    .replace( /[óÓ]/g, 'o' )
                    .replace( /[úÚ]/g, 'u' )
                    .replace( /ê/g, 'e' )
                    .replace( /î/g, 'i' )
                    .replace( /ô/g, 'o' )
                    .replace( /è/g, 'e' )
                    .replace( /ï/g, 'i' )
                    .replace( /ü/g, 'u' )
                    .replace( /ã/g, 'a' )
                    .replace( /õ/g, 'o' )
                    .replace( /ç/g, 'c' )
                    .replace( /ì/g, 'i' ) :
                data;
    };
    
     
          // Buscar sin importar los acentos
          jQuery('#datatable-table_filter input').keyup( function () {
            table
              .search(
                jQuery.fn.DataTable.ext.type.search.string( this.value )
              )
              .draw();
          } );
     

});