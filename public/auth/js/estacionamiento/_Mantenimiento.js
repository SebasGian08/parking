var OnSuccessRegistroEstablecimiento, OnFailureRegistroEstablecimiento;
$(function(){

    const $modal = $("#modalMantenimientoEstablecimiento"), $form = $("form#registroEstablecimiento");

    OnSuccessRegistroEstablecimiento = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroEstablecimiento = () => onFailureForm();
});
