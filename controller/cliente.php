<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Cliente.php");
    /* TODO: Inicializando clase */
    $cliente = new Cliente();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["cli_id"])){
                $cliente->insert_cliente(
                    $_POST["emp_id"],
                    $_POST["cli_nom"],
                    $_POST["cli_ruc"],
                    $_POST["cli_telf"],
                    $_POST["cli_direcc"],
                    $_POST["cli_correo"]);
            }else{
                $cliente->update_cliente(
                    $_POST["cli_id"],
                    $_POST["emp_id"],
                    $_POST["cli_nom"],
                    $_POST["cli_ruc"],
                    $_POST["cli_telf"],
                    $_POST["cli_direcc"],
                    $_POST["cli_correo"]
            );
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$cliente->get_cliente_x_emp_id($_POST["emp_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["CLI_RUC"];
                $sub_array[] = $row["CLI_TELF"];
                $sub_array[] = $row["CLI_CORREO"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="editar('.$row["CLI_ID"].')" id="'.$row["CLI_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["CLI_ID"].')" id="'.$row["CLI_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$cliente->get_cliente_x_cli_id($_POST["cli_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["CLI_ID"] = $row["CLI_ID"];
                    $output["EMP_ID"] = $row["EMP_ID"];
                    $output["CLI_NOM"] = $row["CLI_NOM"];
                    $output["CLI_RUC"] = $row["CLI_RUC"];
                    $output["CLI_TELF"] = $row["CLI_TELF"];
                    $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                    $output["CLI_CORREO"] = $row["CLI_CORREO"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $cliente->delete_cliente($_POST["cli_id"]);
            break;

        /* TODO: Combo de Listado de Clientes */
        case "combo";
            $datos=$cliente->get_cliente_x_emp_id($_POST["emp_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option value='0' selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["CLI_ID"]."'>".$row["CLI_NOM"]."</option>";
                }
                echo $html;
            }
            break;

    }
?>