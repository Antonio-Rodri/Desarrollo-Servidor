<?php

require_once 'Conexion.php';

class alquilerController {

    public static function buscar($cod) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT Nombre,Apellidos FROM cliente JOIN alquiler ON cliente.DNI = alquiler.DNI_cliente WHERE alquiler.cod_juego='$cod' AND alquiler.Fecha_devol IS NULL");
            if ($result->num_rows > 0) {
                $reg = $result->fetch_assoc();
                return $reg['Nombre'] . " " . $reg['Apellidos'];
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
