<?php
    class Venta extends Conectar{

        /* TODO: Listar Registro por ID en especifico */
        public function insert_venta_x_suc_id($suc_id,$usu_id){
            $conectar=parent::Conexion();
            $sql="SP_I_VENTA_01 ?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$usu_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function insert_venta_detalle($vent_id,$prod_id,$prod_pventa,$detv_cant){
            $conectar=parent::Conexion();
            $sql="SP_I_VENTA_02 ?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->bindValue(2,$prod_id);
            $query->bindValue(3,$prod_pventa);
            $query->bindValue(4,$detv_cant);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_venta_detalle($vent_id){
            $conectar=parent::Conexion();
            $sql="SP_L_VENTA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function delete_venta_detalle($detv_id){
            $conectar=parent::Conexion();
            $sql="SP_D_VENTA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$detv_id);
            $query->execute();
        }

        public function get_venta_calculo($vent_id){
            $conectar=parent::Conexion();
            $sql="SP_U_VENTA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function update_venta($vent_id,$pag_id,$cli_id,$cli_ruc,$cli_direcc,$cli_correo,$compv_coment,$mon_id,$doc_id){
            $conectar=parent::Conexion();
            $sql="SP_U_VENTA_03 ?,?,?,?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->bindValue(2,$pag_id);
            $query->bindValue(3,$cli_id);
            $query->bindValue(4,$cli_ruc);
            $query->bindValue(5,$cli_direcc);
            $query->bindValue(6,$cli_correo);
            $query->bindValue(7,$compv_coment);
            $query->bindValue(8,$mon_id);
            $query->bindValue(9,$doc_id);
            $query->execute();
            //return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_venta($vent_id){
            $conectar=parent::Conexion();
            $sql="SP_L_VENTA_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$vent_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_venta_listado($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_VENTA_03 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_venta_top_productos($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_VENTA_04 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        public function get_venta_barras($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_VENTA_06 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }


    }
?>