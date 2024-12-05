var OnSuccessRegistroEmpleado, OnFailureRegistroEmpleado;
$(function(){

    const $modal = $("#modalMantenimientoEmpleado"), $form = $("form#registroEmpleado");

    OnSuccessRegistroEmpleado = (data) => onSuccessForm(data, $form, $modal);
    OnFailureRegistroEmpleado = () => onFailureForm();
});
