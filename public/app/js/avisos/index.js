$(function(){
    $('.btn_evento_bolsa').click();
    const $name = $("#name"), $filterSearch = $(".filterSearch");

    var $area_id = $("#area_filter_id"), $provincia_id = $("#provincia_filter_idd"), $distrito_id = $("#distrito_filter_id"), $tipo_estudiante = $("#tipo_estudiante")
    $horario_id = $("#horario_filter_id"), $modalidad_id = $("#modalidad_filter_id"), $startDate = moment().startOf('month').format("YYYY-MM-DD"),
    $endDate = moment().endOf('month').format("YYYY-MM-DD");

    $name.on("keypress", function(e){
        if (e.keyCode == 13) $filterSearch.click();
    });

    $(document).on("change", "#area_filter_id, #provincia_filter_id, #distrito_filter_id, #horario_filter_id, #modalidad_filter_id, #tipo_estudiante", function(){
        $filterSearch.click();
    });

    $provincia_id.change(function(){
        $distrito_id.html(`<option value=""></option>`);
        if($(this).val() != 0){
            actionAjax("/filtro_distritos/"+$(this).val(), null, "GET", function(data){
                $.each(data, function (i, e) {
                    $distrito_id.append(`<option value="${e.id}">${e.nombre}</option>`);
                });
            });
        }
    });

    let pagination = true;

    listarLeads();

    function listarLeads(){

        listPagination(true);

        $(window).scroll(function(){
            if(pagination)listPagination(false);
        });

        function listPagination(reset){

            const $Page = reset ? window.location.origin + (PERFIL == 2 ? "/alumno/" : "/empresa/") + "avisos/?page=1" : $('.endless-pagination').data('next-page');
            const $Filters = "name="+$name.val()+"&area_id="+$area_id.val()+"&provincia_id="+$provincia_id.val()+"&distrito_id="+$distrito_id.val()+"&horario_id="+$horario_id.val()+"&modalidad_id="+$modalidad_id.val()+"&fecha_inicio="+$startDate+"&fecha_final="+$endDate+"&tipo_estudiante="+$tipo_estudiante.val();
            if($Page !== null){

                if(reset){

                    $("#loading-avisos").show();

                    $.get($Page+"&"+$Filters, function(data){
                        $('.avisos').html("").append(data.avisos);
                        $('.endless-pagination').data('next-page', data.next_page);
                    }).always(function(){
                        $("#loading-avisos").hide();
                    });
                }else{
                    clearTimeout( $.data(this, "scrollCheck") );

                    $.data( this, "scrollCheck", setTimeout( function(){

                        $.data( this, "scrollCheck", setTimeout(function(){
                            var scroll_postion_for_avisos_load = $(window).height() + $(window).scrollTop() + 100;
                            if(scroll_postion_for_avisos_load >= $(document).height()){
                                $("#loading-avisos").show();
                                $.get($Page+"&"+$Filters, function(data){
                                    $('.avisos').append(data.avisos);
                                    $('.endless-pagination').data('next-page', data.next_page);
                                }).done(function(){
                                    $("#loading-avisos").hide();
                                });
                            }
                        }));
                    }, 350));
                }
            }
        }
    }

    moment.locale('es');

    var start = moment().startOf('month');
    var end = moment().endOf('month');

    function changefiltro(start, end, loader) {
        $('#reportrange span').html(loader == "init" ? "Fecha de publicación" : start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        $filterSearch.click();
    }

    $('#reportrange').daterangepicker({
        autoUpdateInput: false,
        startDate: start,
        endDate: end,
        ranges: {
            'Hoy': [moment(), moment()],
            'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Últimos 7 días': [moment().subtract(6, 'days'), moment()],
            'Últimos 30 días': [moment().subtract(29, 'days'), moment()],
            'Este Mes': [moment().startOf('month'), moment().endOf('month')],
            'Mes Anterior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
            'Todo el Año': [moment().subtract(1, 'month').startOf('year'), moment().subtract(1, 'month').endOf('year')]
        }
    }, changefiltro);

    changefiltro(start, end, "init");

    $("body").on("click", ".card",  function () {
        const $empresa = $(this).attr("data-empresa");
        const $id = $(this).attr("data-info");
        verSeguimiento($empresa, $id);
    });

    function verSeguimiento($empresa, $id) {
        window.location.href = (PERFIL == 2 ? "/alumno/" : "/empresa/") + $empresa+"/aviso/"+$id;
    }

    $filterSearch.on("click", function () {
        $startDate = moment($('#reportrange').data('daterangepicker').startDate._d).format("YYYY-MM-DD");
        $endDate = moment($('#reportrange').data('daterangepicker').endDate._d).format("YYYY-MM-DD");
        listarLeads();
    });

});
console.log("aaaaaaaaaaaa");