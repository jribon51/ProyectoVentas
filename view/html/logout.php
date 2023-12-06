<?php 
require_once("../../config/conexion.php");
header("Location:".Conectar::ruta()."?c=".$_SESSION["COM_ID"]);;
session_destroy();
exit();



?>