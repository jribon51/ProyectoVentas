<?php
    /* TODO: Llamando Clases */
    require_once("../config/conexion.php");
    require_once("../models/Venta.php");
    /* TODO: Inicializando clase */
    $venta = new Venta();

    switch($_GET["op"]){
        /* TODO: Registrar nueva venta */
        case "registrar":
            $datos=$venta->insert_venta_x_suc_id($_POST["suc_id"],$_POST["usu_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
            }
            echo json_encode($output);
            break;
        /* TODO: Registrar detalle de venta */
        case "guardardetalle":
            $datos=$venta->insert_venta_detalle($_POST["vent_id"],$_POST["prod_id"],$_POST["prod_pventa"],$_POST["detv_cant"]);
            break;
        /* TODO: Calcular SUBTOTAL,IGV,TOTAL de venta */
        case "calculo":
            $datos=$venta->get_venta_calculo($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
            }
            echo json_encode($output);
            break;
        /* TODO: Eliminar detalle */
        case "eliminardetalle":
            $venta->delete_venta_detalle($_POST["detv_id"]);
            break;
        /* TODO: Listar detalle de venta  */
        case "listardetalle":
            $datos=$venta->get_venta_detalle($_POST["vent_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                if ($row["PROD_IMG"] != ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                $sub_array[] = $row["CAT_NOM"];
                $sub_array[] = $row["PROD_NOM"];
                $sub_array[] = $row["UND_NOM"];
                $sub_array[] = $row["PROD_PVENTA"];
                $sub_array[] = $row["DETV_CANT"];
                $sub_array[] = $row["DETV_TOTAL"];
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["DETV_ID"].','.$row["VENT_ID"].')" id="'.$row["DETV_ID"].'" class="btn btn-danger btn-icon waves-effect waves-light"><i class="ri-delete-bin-5-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /* TODO: Listar formato de detalle de venta por ID */
        case "listardetalleformato";
            $datos=$venta->get_venta_detalle($_POST["vent_id"]);
            foreach($datos as $row){
                ?>
                     <tr>
                        <td>
                            <?php 
                                if ($row["PROD_IMG"] != ''){
                                    ?>
                                        <?php
                                            echo "<div class='d-flex align-items-center'>" .
                                                    "<div class='flex-shrink-0 me-2'>".
                                                        "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                                                    "</div>".
                                                "</div>";
                                        ?>
                                    <?php
                                }else{
                                    ?>
                                        <?php 
                                            echo "<div class='d-flex align-items-center'>" .
                                                    "<div class='flex-shrink-0 me-2'>".
                                                        "<img src='../../assets/producto/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                                                    "</div>".
                                                "</div>";
                                        ?>
                                    <?php
                                }
                            ?>
                        </td>
                        <td><?php echo $row["CAT_NOM"];?></td>
                        <td><?php echo $row["PROD_NOM"];?></td>
                        <td scope="row"><?php echo $row["UND_NOM"];?></td>
                        <td><?php echo $row["PROD_PVENTA"];?></td>
                        <td><?php echo $row["DETV_CANT"];?></td>
                        <td class="text-end"><?php echo $row["DETV_TOTAL"];?></td>
                    </tr>
                <?php
            }
            break;
        /* TODO: Guardar venta */
        case "guardar":
            $datos=$venta->update_venta(
                $_POST["vent_id"],
                $_POST["pag_id"],
                $_POST["cli_id"],
                $_POST["cli_ruc"],
                $_POST["cli_direcc"],
                $_POST["cli_correo"],
                $_POST["vent_coment"],
                $_POST["mon_id"],
                $_POST["doc_id"]
            );
            break;
        /* TODO: Mostrar informacion de venta por ID */
        case "mostrar":
            $datos=$venta->get_venta($_POST["vent_id"]);
            foreach($datos as $row){
                $output["VENT_ID"] = $row["VENT_ID"];
                $output["SUC_ID"] = $row["SUC_ID"];
                $output["PAG_ID"] = $row["PAG_ID"];
                $output["PAG_NOM"] = $row["PAG_NOM"];
                $output["CLI_ID"] = $row["CLI_ID"];
                $output["CLI_RUC"] = $row["CLI_RUC"];
                $output["CLI_DIRECC"] = $row["CLI_DIRECC"];
                $output["CLI_CORREO"] = $row["CLI_CORREO"];
                $output["VENT_SUBTOTAL"] = $row["VENT_SUBTOTAL"];
                $output["VENT_IGV"] = $row["VENT_IGV"];
                $output["VENT_TOTAL"] = $row["VENT_TOTAL"];
                $output["VENT_COMENT"] = $row["VENT_COMENT"];
                $output["USU_ID"] = $row["USU_ID"];
                $output["USU_NOM"] = $row["USU_NOM"];
                $output["USU_APE"] = $row["USU_APE"];
                $output["USU_CORREO"] = $row["USU_CORREO"];
                $output["MON_ID"] = $row["MON_ID"];
                $output["MON_NOM"] = $row["MON_NOM"];
                $output["FECH_CREA"] = $row["FECH_CREA"];
                $output["SUC_NOM"] = $row["SUC_NOM"];
                $output["EMP_NOM"] = $row["EMP_NOM"];
                $output["EMP_RUC"] = $row["EMP_RUC"];
                $output["EMP_CORREO"] = $row["EMP_CORREO"];
                $output["EMP_TELF"] = $row["EMP_TELF"];
                $output["EMP_DIRECC"] = $row["EMP_DIRECC"];
                $output["EMP_PAG"] = $row["EMP_PAG"];
                $output["COM_NOM"] = $row["COM_NOM"];
                $output["CLI_NOM"] = $row["CLI_NOM"];
            }
            echo json_encode($output);
            break;
        /* TODO: Listar venta por sucursal */
        case "listarventa":
            $datos=$venta->get_venta_listado($_POST["suc_id"]);
            $data=Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = "V-".$row["VENT_ID"];
                $sub_array[] = $row["DOC_NOM"];
                $sub_array[] = $row["CLI_RUC"];
                $sub_array[] = $row["CLI_NOM"];
                $sub_array[] = $row["PAG_NOM"];
                $sub_array[] = $row["MON_NOM"];
                $sub_array[] = $row["VENT_SUBTOTAL"];
                $sub_array[] = $row["VENT_IGV"];
                $sub_array[] = $row["VENT_TOTAL"];
                $sub_array[] = $row["USU_NOM"]." ".$row["USU_APE"];
                if ($row["USU_IMG"] != ''){
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/usuario/".$row["USU_IMG"]."' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }else{
                    $sub_array[] =
                    "<div class='d-flex align-items-center'>" .
                        "<div class='flex-shrink-0 me-2'>".
                            "<img src='../../assets/usuario/no_imagen.png' alt='' class='avatar-xs rounded-circle'>".
                        "</div>".
                    "</div>";
                }
                $sub_array[] = '<a href="../ViewVenta/?v='.$row["VENT_ID"].'" target="_blank" class="btn btn-primary btn-icon waves-effect waves-light"><i class="ri-printer-line"></i></a>';
                $sub_array[] = '<button type="button" onClick="ver('.$row["VENT_ID"].')" id="'.$row["VENT_ID"].'" class="btn btn-success btn-icon waves-effect waves-light"><i class="ri-settings-2-line"></i></button>';
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /* TODO: Listar to5 productos mas vendidos */
        case "listartopproducto";
            $datos=$venta->get_venta_top_productos($_POST["suc_id"]);
            foreach($datos as $row){
                ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-light rounded p-1 me-2">
                                <?php
                                    if ($row["PROD_IMG"] != ''){
                                        ?>
                                            <?php
                                                echo "<img src='../../assets/producto/".$row["PROD_IMG"]."' alt='' class='img-fluid d-block' />";
                                            ?>
                                        <?php
                                    }else{
                                        ?>
                                            <?php 
                                                echo "<img src='../../assets/producto/no_imagen.png' alt='' class='img-fluid d-block' />";
                                            ?>
                                        <?php
                                    }
                                ?>
                                </div>
                                <div>
                                    <h5 class="fs-14 my-1"><?php echo $row["PROD_NOM"];?></h5>
                                    <span class="text-muted"><?php echo $row["CAT_NOM"];?></span>
                                </div>
                            </div>
                        </td>
                        <td>
                            <h5 class="fs-14 my-1 fw-normal"><?php echo $row["PROD_PVENTA"];?></h5>
                            <span class="text-muted">P.Venta</span>
                        </td>
                        <td>
                            <h5 class="fs-14 my-1 fw-normal"><?php echo $row["CANT"];?></h5>
                            <span class="text-muted">Cant</span>
                        </td>
                        <td>
                            <h5 class="fs-14 my-1 fw-normal"><?php echo $row["PROD_STOCK"];?></h5>
                            <span class="text-muted">Stock</span>
                        </td>
                        <td>
                            <h5 class="fs-14 my-1 fw-normal"><b><?php echo $row["MON_NOM"];?></b> <?php echo $row["TOTAL"];?></h5>
                            <span class="text-muted">Total</span>
                        </td>
                    </tr>
                <?php
            }
            break;
        /* TODO:Informacion para barra de venta del Dashboard */
        case "barras":
            $datos=$venta->get_venta_barras($_POST["suc_id"]);
            $data = array();
            foreach($datos as $row){
                $data[]=$row;
            }
            echo json_encode($data);
            break;

    }
?>