$(document).ready(function () {

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
            matricula2: {
                required: true,
                normalizer: function (value) {
                    return $.trim(value);
                },
                equalTo: "#matricula"
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
            nombre: "Dato requerido",
            apellidos: "Dato requerido",
            matricula: {
                required: "Dato requerido",
                minlength: "La matrícula debe ser de 9 carácteres",
                maxlength: "La matrícula debe ser de 9 carácteres"
            },
            matricula2: {
                required: "Dato requerido",
                equalTo: "La matrícula no coincide"
            },
            bloque: "Selecciona un bloque",
            seccion: "Selecciona una sección",
			correo : {
                required: "Dato requerido",
                email: "Ingrese una dirección de correo valida"
            },
			telefono : "Dato requerido",
			contrasena: {
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
           // $("#modalConfirmacion").show();
            $('#modalConfirmacion').modal('show');
        }
    });
    
    $("#botonCancelar").click(function(){
        $("#modalConfirmacion").modal('hide');
    });

    $("#botonEnviar").click(function(){
        
    });

  

    $("#telefono").keypress(function(e){
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 46))
            return true;
        return /\d/.test(String.fromCharCode(keynum));
    });

});



