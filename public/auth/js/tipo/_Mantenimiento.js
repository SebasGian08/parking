var OnSuccessRegistroTipo, OnFailureRegistroTipo;
$(function(){

    const $modal = $("#modalMantenimientoTipo"), $form = $("form#registroTipo");

    OnSuccessRegistroTipo= (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroTipo = () => onFailureForm();
});
