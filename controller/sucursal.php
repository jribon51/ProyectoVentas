<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Sucursal.php");
    /* TODO: Inicializando clase */
    $sucursal = new Sucursal();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["suc_id"])){
                $sucursal->insert_sucursal($_POST["emp_id"],$_POST["suc_nom"]);
            }else{
                $sucursal->update_sucursal($_POST["suc_id"],$_POST["emp_id"],$_POST["suc_nom"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$sucursal->get_sucursal_x_emp_id($_POST["emp_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["SUC_NOM"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["SUC_ID"].')" id="'.$row["SUC_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["SUC_ID"].')" id="'.$row["SUC_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$sucursal->get_sucursal_x_suc_id($_POST["suc_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["EMP_ID"] = $row["EMP_ID"];
                    $output["SUC_NOM"] = $row["SUC_NOM"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $sucursal->delete_sucursal($_POST["suc_id"]);
            break;
        /* TODO: Listar Combo */
        case "combo";
            $datos=$sucursal->get_sucursal_x_emp_id($_POST["emp_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["SUC_ID"]."'>".$row["SUC_NOM"]."</option>";
                }
                echo $html;
            }
            break;
    }
?>