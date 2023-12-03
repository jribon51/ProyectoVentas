$(document).ready(function () {
    $.post("/ProyectoVentas/controller/empresa.php?op=combo", { com_id: 1 }, function (data) {
        $("#emp_id").html(data);
    }).fail(function (xhr, status, error) {
        console.error("Error en la solicitud:", status, error);
    });
});