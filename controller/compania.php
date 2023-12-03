<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Compania.php");
    /* TODO: Inicializando clase */
    $compania = new Compania();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["com_id"])){
                $compania->insert_compania($_POST["com_nom"]);
            }else{
                $compania->update_compania($_POST["com_id"],$_POST["com_nom"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$compania->get_compania();
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array = $row["com_nom"];
                $sub_array = "Editar";
                $sub_array = "Eliminar";
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;

        /* TODO:Mostrar informacion de registro segun su ID */
        case "mostrar":
            $datos=$compania->get_compania_x_com_id($_POST["com_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["com_id"] = $row["com_id"];
                    $output["com_nom"] = $row["com_nom"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $compania->delete_compania($_POST["com_id"]);
            break;

    }
?>