<?php
    class Conectar{
        protected $dbh;

        protected function Conexion(){
            try {
                $conectar=$this->dbh=new PDO("sqlsrv:server=localhost;database=CompraVenta","jose","Jribon51");
                return $conectar;
            } catch (Exception $e) {
                print "Error conexion BD". $e->getmessage() ."<br/>";
                die();
            }
        }

    }
?>