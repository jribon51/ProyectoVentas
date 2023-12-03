<?php
    class Conectar{
        protected $dbh;

        public static function Conexion(){
            try {
                $conectar=new PDO("sqlsrv:server=tcp:database-sql-server-ventas.c9ldadwndkp0.us-east-2.rds.amazonaws.com,1433;database=CompraVenta","admin","Jribon51");
                return $conectar;
            } catch (Exception $e) {
                print "Error conexion BD". $e->getmessage() ."<br/>";
                die();
            }
        }

    }

?>

