<?php
require_once 'Conexion.php';
require_once '../model/Cliente.php';
require_once '../model/Coche.php';
require_once '../model/Empleado.php';
require_once '../model/Tarea.php';
require_once '../model/Trabajo.php';

class trabajoController {

    public static function registrarInsertar($coche, $cliente, $tareas, $mecanico) {
        try {
            $conex = new Conexion();
            $conex->begin_transaction();
            $conex->query("INSERT INTO coche VALUES ('$coche->matricula', '$coche->marca', '$coche->modelo', $coche->km, '$coche->foto', '$cliente->dni') ");
            $conex->query("UPDATE cliente SET nombrecompleto = '$cliente->nombrecompleto', SET direccion = '$cliente->direccion', SET telf = '$cliente->telf' WHERE dni = '$cliente->dni'");
            foreach ($tareas as $tarea) {
                $conex->query("INSERT INTO trabajo VALUES ('$coche->matricula', '$mecanico', '$tarea->id', '" . date('Y-m-d') . "', 'Pendiente', 0)");
            }
            $conex->commit();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function registrarUpdate($coche, $cliente, $tareas, $mecanico) {
        try {
            $conex = new Conexion();
            $conex->begin_transaction();
            $conex->query("UPDATE coche SET marca = '$coche->marca', modelo = '$coche->modelo', km = $coche->km, foto = '$coche->foto', dni_cliente = '$cliente->dni' WHERE matricula= '$coche->matricula'");
            $conex->query("UPDATE cliente SET nombrecompleto = '$cliente->nombrecompleto', SET direccion = '$cliente->direccion', SET telf = '$cliente->telf' WHERE dni = '$cliente->dni'");
            foreach ($tareas as $tarea) {
                $conex->query("INSERT INTO trabajo VALUES ('$coche->matricula', '$mecanico', '$tarea->id', '" . date('Y-m-d') . "', 'Pendiente', 0)");
            }
            $conex->commit();
        } catch (PDOException $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function trabajoMecanico($mecanico) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM trabajo WHERE cod_mecanico = $mecanico");
            $trabajos = [];
            while ($row = $result->fetch()){
                $trabajo = new Trabajo($row['matricula'], $row['cod_mecanico'], $row['id_tarea'], $row['fecha'], $row['estado'], $row['horas']);
                $trabajos[] = $trabajo;
            }
            return $trabajos;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
