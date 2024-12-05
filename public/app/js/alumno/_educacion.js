var OnSuccessRegistroEducacion, OnFailureRegistroEducacion;
$(function(){

    const $modal = $("#modalMantenimientoEducacion"), $form = $("form#registroEducacion"),
          $egresado = $modal.find("#estado");

    if(parseInt($egresado.val()) !== TIPO_ALUMNOS.TIPO_ALUMNO){
        $("#modalMantenimientoEducacion #anio option[value='En Curso']").hide();
    }

    $egresado.on("change", function(){
        if(parseInt($(this).val()) === TIPO_ALUMNOS.TIPO_ALUMNO){
            $("#modalMantenimientoEducacion #anio option[value='En Curso']").show();
            $("#modalMantenimientoEducacion #anio").val("En Curso").prop("disabled", true);
        }else{
            $("#modalMantenimientoEducacion #anio option[value='En Curso']").hide();
            $("#modalMantenimientoEducacion #anio").val("").prop("disabled", false);
        }
    });

    OnSuccessRegistroEducacion = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroEducacion = () => onFailureForm();

});


$(document).on('change', '#estado', function(event) {
    // $('#estado').val($("#estado option:selected").text());
    inputs_validation()
});

function inputs_validation(){
    $("#ciclo").hide();

    var txt = $('#estado').val()
/*     console.log('esto es el estado : ',txt) */
    if(txt != 0){
        $("#fin_estudio").show();
        $("#ciclo").hide();       
        $("#estado_estudiante").hide();
        $('#inicio_estudio').removeClass('col-md-6').addClass('col-md-3')
        $("#select_estado_estd").attr('required', false)
        $("#ciclo").attr('required', false);
    }
    else{
        $("#fin_estudio").hide();
        $("#ciclo").show();
        $("#estado_estudiante").show();
        $('#inicio_estudio').removeClass('col-md-3').addClass('col-md-6')
        $("#select_estado_estd").attr('required', true)
        $("#ciclo").attr('required', true);
    }
}
inputs_validation()

















