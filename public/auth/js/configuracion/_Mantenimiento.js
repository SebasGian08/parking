var OnSuccessRegistroConfiguracion, OnFailureRegistroConfiguracion;
$(function(){

    const $modal = $("#modalMantenimientoConfiguracion"), $form = $("form#registroConfiguracion");

    OnSuccessRegistroConfiguracion = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroConfiguracion = () => onFailureForm();
});
