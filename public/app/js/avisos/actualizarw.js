// JavaScript para el formulario
var OnSuccessRegistroAviso, OnFailureRegistroAviso;
$(function () {
    /* CKEDITOR.replace('descripcion'); */

    $(".modal-footer button").on('click', function(e) {
        for (var instanceName in CKEDITOR.instances) {
            CKEDITOR.instances[instanceName].updateElement();
        }
    });

    // $("#registroAviso").on('submit', function(event) {
    //     event.preventDefault();

    //     for (var instanceName in CKEDITOR.instances) {
    //         CKEDITOR.instances[instanceName].updateElement();
    //     }

    //     if (validateForm()) {
    //         actionAjax(
    //             $(this).attr('action'),
    //             $(this).serialize(),
    //             'POST',  // Asegúrate de que el método es POST
    //             function (data) {
    //                 OnSuccessRegistroAviso(data);
    //             },
    //             function () {
    //                 OnFailureRegistroAviso();
    //             }
    //         );
    //     } else {
    //         $(this)[0].reportValidity();
    //     }
    // });

    // function validateForm() {
    //     return $("#registroAviso")[0].checkValidity();
    // }

    OnSuccessRegistroAviso = (data) => onSuccessForm(data, $("form#registroAvisox"), $("#modalMantenimientoAviso"));
    OnFailureRegistroAviso = () => onFailureForm();

    $(document).on('change', '#solicita_grado_a', function(event) {
        inputs_validation();
    });

    function inputs_validation() {
        var txt = $('#solicita_grado_a').val();
        if (txt != 0) {
            $("#ciclo_cursa").hide();
            $("#ciclo_cursa").attr('required', false);
        } else {
            $("#ciclo_cursa").show();
            $("#ciclo_cursa").attr('required', true);
        }
    }
    inputs_validation();
});
