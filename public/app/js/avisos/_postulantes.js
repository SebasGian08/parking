$(function(){

    const $table = $("#tablePostulante");

    const $dataTablePostulante = $table.DataTable({
        "stripeClasses": ['odd-row', 'even-row'],
        "lengthChange": false,
        "lengthMenu": false,
        "searching": false,
        "paging": true,
        "info": false,
        "buttons": [],
        "ajax": {
            url: "/empresa/avisos/list_all_postulantes",
            data: function (s) {
                s.id = $("#id").val();
            }
        },
        "columns": [
            { title: "Alumno", data: "alumnos", className: "text-center", render: function (data){
                return data.nombres + " " + data.apellidos;
            }},
            { title: "DNI", data: "alumnos.dni", className: "text-center" },
            { title: "Teléfono", data: "alumnos.telefono", className: "text-center" },
            { title: "E-mail", data: "alumnos.email", className: "text-center" },
            { title: "Usuario", data: "alumnos.usuario_alumno", className: "text-center" },
            { title: "Fecha de Registro", data: "created_at"}
        ]
    });


});
