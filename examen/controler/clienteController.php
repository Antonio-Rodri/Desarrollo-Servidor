<?php

require_once 'Conexion.php';
require_once '../model/Cliente.php';

class clienteController {

    public static function buscar($dni) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM cliente WHERE dni='$dni'");
            if ($result->rowCount() == 0) {
                $cliente = false;
            } else {
                $row = $result->fetch();
                $cliente = new Cliente($row['dni'], $row['nombrecompleto'], $row['direccion'], $row['telf']);
            }
            return $cliente;
            $conex->close();
        } catch (Exception $exc) {
            $cliente = false;
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return $cliente;
        }
    }
}
