<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Rol.php");
    /* TODO: Inicializando clase */
    $rol = new Rol();

    switch($_GET["op"]){
        /* TODO: Guardar y editar, guardar cuando el ID este vacio, y Actualizar cuando se envie el ID */
        case "guardaryeditar":
            if(empty($_POST["rol_id"])){
                $rol->insert_rol($_POST["suc_id"],$_POST["rol_nom"]);
            }else{
                $rol->update_rol($_POST["rol_id"],$_POST["suc_id"],$_POST["rol_nom"]);
            }
            break;

        /* TODO: Listado de registros formato JSON para Datatable JS */
        case "listar":
            $datos=$rol->get_rol_x_suc_id($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["ROL_NOM"];
                $sub_array[] = $row["FECH_CREA"];
                $sub_array[] = '<button type="button" onClick="permiso('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-warning btn-icon waves-effect waves-light"><i class="ri-edit-2-line"></i></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["ROL_ID"].')" id="'.$row["ROL_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
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
            $datos=$rol->get_rol_x_rol_id($_POST["rol_id"]);
            if (is_array($datos)==true and count($datos)>0){
                foreach($datos as $row){
                    $output["ROL_ID"] = $row["ROL_ID"];
                    $output["SUC_ID"] = $row["SUC_ID"];
                    $output["ROL_NOM"] = $row["ROL_NOM"];
                }
                echo json_encode($output);
            }
            break;

        /* TODO: Cambiar Estado a 0 del Registro */
        case "eliminar";
            $rol->delete_rol($_POST["rol_id"]);
            break;
        /* TODO: Listar Combo */
        case "combo";
            $datos=$rol->get_rol_x_suc_id($_POST["suc_id"]);
            if(is_array($datos)==true and count($datos)>0){
                $html="";
                $html.="<option selected>Seleccionar</option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row["ROL_ID"]."'>".$row["ROL_NOM"]."</option>";
                }
                echo $html;
            }
            break;

    }
?>