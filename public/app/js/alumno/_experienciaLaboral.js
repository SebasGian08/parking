//var OnSuccessRegistroExperienciaLaboral,
//var OnFailureRegistroExperienciaLaboral;
$(function(){

    const $modal = $("#modalMantenimientoExperienciaLaboral"), $form = $("form#registroExperienciaLaboral");

    $form.on('submit', function (e) {
        e.preventDefault();

        for(var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
        const formData = new FormData($(this)[0]);
        // formData.append('descripcion', CKEDITOR.instances['descripcion'].getData());
        actionAjax("/alumno/perfil/experiencia", formData, "POST", function(data){
            onSuccessForm(data, $form, $modal, null, true);
        });
    });

    //OnSuccessRegistroExperienciaLaboral = (data) => onSuccessForm(data, $form, $modal);
    //OnFailureRegistroExperienciaLaboral = () => onFailureForm();
});


$(document).on('change', '#estado', function(event) {
    inputs_validation()
});


function inputs_validation(){
    $("#inicio_laburo").hide();
    $("#fin_laburo").hide();
    var txt = $('#estado').val()
    if(txt == "Hasta la actualidad"){
        $("#inicio_laburo").show();     
        $("#fin_laburo").attr('required', false)
        $("#inicio_laburo").attr('required', true);
    }
    else if(txt == "Culminado"){
        $("#inicio_laburo").show();
        $("#fin_laburo").show();
        $("#inicio_laburo").attr('required', true)
        $("#fin_laburo").attr('required', true);
    }
}
inputs_validation()
