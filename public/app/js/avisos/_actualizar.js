var OnSuccessRegistroAviso, OnFailureRegistroAviso;
$(function(){

    const $modal = $("#modalMantenimientoAviso"), $form = $("form#registroAviso");

    const $provincia_id = $("#provincia_id"), $distrito_id = $("#distrito_id");

    $provincia_id.change(function(){
        $distrito_id.html("");
        if($(this).val() != 0){
            actionAjax("/filtro_distritos/"+$(this).val(), null, "GET", function(data){
                $.each(data, function (i, e) {
                    $distrito_id.append(`<option value="${e.id}">${e.nombre}</option>`);
                });
            });
        }
    });

    OnSuccessRegistroAviso = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroAviso = () => onFailureForm();
});
