<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Documento.php");
    /* TODO: Inicializando clase */
    $documento = new Documento();

    switch($_GET["op"]){

        /* TODO: Listar Combo */
        case "combo";
            $datos=$documento->get_documento($_POST["doc_tipo"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["DOC_ID"]."'>".$row["DOC_NOM"]."</option>";
                }
                echo $html;
            }
            break;

    }
?>