<?php
    class Producto extends Conectar{
        /* TODO: Listar Registros */
        public function get_producto_x_suc_id($suc_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PRODUCTO_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Listar Registro por ID en especifico */
        public function get_producto_x_prod_id($prod_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PRODUCTO_02 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO:Listado de Productos por categoria */
        public function get_producto_x_cat_id($cat_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PRODUCTO_03 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$cat_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }

        /* TODO: Eliminar o cambiar estado a eliminado */
        public function delete_producto($prod_id){
            $conectar=parent::Conexion();
            $sql="SP_D_PRODUCTO_01 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
        }

        /* TODO: Registro de datos */
        public function insert_producto($suc_id,$cat_id,$prod_nom,$prod_descrip,$und_id,
                                        $mon_id,$prod_pcompra,$prod_pventa,$prod_stock,
                                        $prod_fechaven,$prod_img){
            $conectar=parent::Conexion();

            require_once("Producto.php");
            $prod=new Producto();
            $prod_img='';
            if($_FILES["prod_img"]["name"] !=''){
                $prod_img=$prod->upload_image();
            }

            $sql="SP_I_PRODUCTO_01 ?,?,?,?,?,?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$suc_id);
            $query->bindValue(2,$cat_id);
            $query->bindValue(3,$prod_nom);
            $query->bindValue(4,$prod_descrip);
            $query->bindValue(5,$und_id);
            $query->bindValue(6,$mon_id);
            $query->bindValue(7,$prod_pcompra);
            $query->bindValue(8,$prod_pventa);
            $query->bindValue(9,$prod_stock);
            $query->bindValue(10,$prod_fechaven);
            $query->bindValue(11,$prod_img);
            $query->execute();
        }

        /* TODO:Actualizar Datos */
        public function update_producto($prod_id,$suc_id,$cat_id,$prod_nom,$prod_descrip,$und_id,
                                        $mon_id,$prod_pcompra,$prod_pventa,$prod_stock,
                                        $prod_fechaven,$prod_img){
            $conectar=parent::Conexion();

            require_once("Producto.php");
            $prod=new Producto();
            $prod_img='';
            if($_FILES["prod_img"]["name"] !=''){
                $prod_img=$prod->upload_image();
            }else{
                $prod_img = $POST["hidden_producto_imagen"];
            }

            $sql="SP_U_PRODUCTO_01 ?,?,?,?,?,?,?,?,?,?,?,?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->bindValue(2,$suc_id);
            $query->bindValue(3,$cat_id);
            $query->bindValue(4,$prod_nom);
            $query->bindValue(5,$prod_descrip);
            $query->bindValue(6,$und_id);
            $query->bindValue(7,$mon_id);
            $query->bindValue(8,$prod_pcompra);
            $query->bindValue(9,$prod_pventa);
            $query->bindValue(10,$prod_stock);
            $query->bindValue(11,$prod_fechaven);
            $query->bindValue(12,$prod_img);
            $query->execute();
        }

        /* TODO: Registrar Imagen */
        public function upload_image(){
            if (isset($_FILES["prod_img"])){
                $extension = explode('.', $_FILES['prod_img']['name']);
                $new_name = rand() . '.' . $extension[1];
                $destination = '../assets/producto/' . $new_name;
                move_uploaded_file($_FILES['prod_img']['tmp_name'], $destination);
                return $new_name;
            }
        }

        /* TODO: Consumo de productos */
        public function get_producto_consumo($prod_id){
            $conectar=parent::Conexion();
            $sql="SP_L_PRODUCTO_05 ?";
            $query=$conectar->prepare($sql);
            $query->bindValue(1,$prod_id);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>