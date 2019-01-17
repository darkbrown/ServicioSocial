$(document).ready(function () {
    var base_url = window.location.origin;
    $('input#buscar').quicksearch('table tbody tr');

    $(".editar").click(function(e){
        e.preventDefault();
        var matricula = $(this).parents("tr").find('td:eq(2)').text().trim();
        matricula = encodeURIComponent(btoa(matricula));
        window.open(base_url + "/ServicioSocial/index.php/EditarAlumno/" + matricula);     
    });

});