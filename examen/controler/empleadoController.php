<?php

require_once 'Conexion.php';
require_once '../model/Empleado.php';

class empleadoController {

    public static function verificar($codigo, $clave) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM empleado WHERE codigo='$codigo'");
            if ($result->rowCount() == 0) {
                $empleado = false;
            } else {
                $row = $result->fetch();
                if (password_verify($clave, $row['clave'])) {
                    $empleado = new Empleado($row['codigo'], $row['clave'], $row['nombrecompleto'], $row['telf'], $row['rol']);
                } else {
                    $empleado = false;
                }
            }
            return $empleado;
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function buscarMecanicos() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM empleado WHERE rol='mecanico'");
            $empleados = [];
            while($row = $result->fetch()){
                $empleado = new Empleado($row['codigo'], $row['clave'], $row['nombrecompleto'], $row['telf'], $row['rol']);
                $empleados[] = $empleado; 
            }
            return $empleados;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
