<?php
    class Moneda extends Conectar{
        /* TODO: Listar Registros */
        public function get_moneda_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_MONEDA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_moneda_x_mon_id($mon_id){
            $conectar=parent::Conexion();
            $sql="SP_L_MONEDA_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_moneda($mon_id){
            $conectar=parent::Conexion();
            $sql="SP_D_MONEDA_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        public function insert_moneda($suc_id,$mon_nom){
            $conectar=parent::Conexion();
            $sql="SP_I_MONEDA_01 ?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$mon_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_moneda($mon_id,$suc_id,$mon_nom){
            $conectar=parent::Conexion();
            $sql="SP_U_MONEDA_01 ?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$mon_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$mon_nom);
            $query->execute();
        }
    }
?>