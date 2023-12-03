<?php
    class Proveedor extends Conectar{
        /* TODO: Listar Registros */
        public function get_proveedor_x_emp_id($emp_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PROVEEDOR_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_proveedor_x_prov_id($prov_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PROVEEDOR_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_proveedor($prov_id){
            $conectar=parent::Conexion();
            $sql="SP_D_PROVEEDOR_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        public function insert_proveedor($emp_id,$prov_nom,$prov_ruc,$prov_telf,$prov_direcc,$prov_correo){
            $conectar=parent::Conexion();
            $sql="SP_I_PROVEEDOR_01 ?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->bindValue(2,$prov_nom);
            $query->bindValue(3,$prov_ruc);
            $query->bindValue(4,$prov_telf);
            $query->bindValue(5,$prov_direcc);
            $query->bindValue(6,$prov_correo);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_proveedor($prov_id,$emp_id,$prov_nom,$prov_ruc,$prov_telf,$prov_direcc,$prov_correo){
            $conectar=parent::Conexion();
            $sql="SP_U_PROVEEDOR_01 ?,?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prov_id);
            $query->bindValue(2,$emp_id);
            $query->bindValue(3,$prov_nom);
            $query->bindValue(4,$prov_ruc);
            $query->bindValue(5,$prov_telf);
            $query->bindValue(6,$prov_direcc);
            $query->bindValue(7,$prov_correo);
            $query->execute();
        }
    }
?>