var OnSuccessRegistroExtras, OnFailureRegistroExtras;
$(function(){

    const $modal = $("#modalMantenimientoExtras"), $form = $("form#registroExtras");

    OnSuccessRegistroExtras = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroExtras = () => onFailureForm();
});
