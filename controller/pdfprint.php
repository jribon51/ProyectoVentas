<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Pdfprint.php");
    /* TODO: Inicializando clase */
    $pdfprint = new Pdfprint();

    switch($_GET["op"]){
        case "pdfventa":
            $pdfprint->generar_pdf_venta($_GET["vent_id"]);
            break;
    }
?>