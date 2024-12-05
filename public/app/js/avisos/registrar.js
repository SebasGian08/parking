$(function(){
    $("form").on('submit', function (e) {
        for (var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
    });

    var TipoPersona = $("#tipo_persona").val();

    if(TipoPersona == 1){
        $("#vacantes").attr("placeholder", "Cantidad de Vacantes Disponibles")
    }else if(TipoPersona == 2){
        $("#titulo").attr("placeholder", "Titulo del empleo que busca")
        $("#vacantes").attr("placeholder", "Cantidad de Personas que Requiere")
        // $("#titulo").attr("hidden", true)
        // $("#titulo").attr("required", false)
    }else if(TipoPersona == 3){
        $("#vacantes").attr("placeholder", "Cantidad de Personas que Requiere")
        // $("#titulo").attr("hidden", true)
        // $("#titulo").attr("required", false)
    }



























});
