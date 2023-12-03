<?php
    class Sucursal extends Conectar{
        /* TODO: Listar Registros */
        public function get_sucursal_x_emp_id($emp_id){
            $conectar=parent::Conexion();
            $sql="SP_L_SUCURSAL_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_sucursal_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_SUCURSAL_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_sucursal($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_D_SUCURSAL_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        public function insert_sucursal($emp_id,$suc_nom){
            $conectar=parent::Conexion();
            $sql="SP_I_SUCURSAL_01 ?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$emp_id);
            $query->bindValue(2,$suc_nom);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_sucursal($suc_id,$emp_id,$suc_nom){
            $conectar=parent::Conexion();
            $sql="SP_U_SUCURSAL_01 ?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$emp_id);
            $query->bindValue(3,$suc_nom);
            $query->execute();
        }
    }
?>