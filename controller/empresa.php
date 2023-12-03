<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Empresa.php");
    /* TODO: Inicializando clase */
    $empresa = new Empresa();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["emp_id"])){
                $empresa->insert_empresa($_POST["com_id"],$_POST["emp_nom"],$_POST["emp_ruc"]);
            }else{
                $empresa->update_empresa($_POST["emp_id"],$_POST["com_id"],$_POST["emp_nom"],$_POST["emp_ruc"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$empresa->get_empresa_x_com_id($_POST["com_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["EMP_RUC"];
                $sub_array[] = $row["EMP_NOM"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["EMP_ID"].')" id="'.$row["EMP_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["EMP_ID"].')" id="'.$row["EMP_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$empresa->get_empresa_x_emp_id($_POST["emp_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["EMP_ID"] = $row["EMP_ID"];
                    $output["COM_ID"] = $row["COM_ID"];
                    $output["EMP_NOM"] = $row["EMP_NOM"];
                    $output["EMP_RUC"] = $row["EMP_RUC"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $empresa->delete_empresa($_POST["emp_id"]);
            break;

        /* TODO: Listar Combo */
        case "combo";
            $datos=$empresa->get_empresa_x_com_id($_POST["com_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["EMP_ID"]."'>".$row["EMP_NOM"]."</option>";
                }
                echo $html;
            }
            break;
    }
?>