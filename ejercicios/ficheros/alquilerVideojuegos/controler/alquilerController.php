<?php

require_once 'Conexion.php';
require_once 'juegosController.php';
require_once '../model/Juego.php';
require_once '../model/Cliente.php';
require_once '../model/Alquiler.php';

class alquilerController {

    public static function buscarAlquilador($cod) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT Nombre,Apellidos,Fecha_alquiler FROM cliente JOIN alquiler ON cliente.DNI = alquiler.DNI_cliente WHERE alquiler.cod_juego='$cod' AND alquiler.Fecha_devol IS NULL");
            if ($result->num_rows > 0) {
                $reg = $result->fetch_assoc();
                $reg['prevista'] = new DateTime($reg['Fecha_alquiler']);
                $reg['prevista']->modify("+7 days");
                $reg['prevista'] = $reg['prevista']->format("d-M-Y");
                return $reg;
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function alquilar($j, $c) {
        try {
            $conex = new Conexion();
            $conex->begin_transaction();
            $conex->query("UPDATE juegos SET Alquilado = 'SI' WHERE Codigo = '$j->codigo'");
            $conex->query("INSERT INTO alquiler (Cod_juego, DNI_cliente, Fecha_alquiler) VALUES ('$j->codigo', '$c->dni', '" . date("Y-m-d") . "')");
            $conex->commit();
            return true;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return false;
        }
    }

    public static function buscarAlquilados($dni) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos join alquiler ON juegos.Codigo = alquiler.Cod_juego WHERE alquiler.DNI_cliente = '$dni'");
            $alquileres = [];
            while ($row = $result->fetch_assoc()) {
                $j = new Juego($row['Codigo'], $row['Nombre_juego'], $row['Nombre_consola'], $row['Anno'], $row['Precio'], $row['Alquilado'], $row['Imagen'], $row['descripcion']);
                $a = new Alquiler($row['id'], $row['Cod_juego'], $row['DNI_cliente'], $row['Fecha_alquiler'], $row['Fecha_devol']);
                $alquileres[] = ['juego' => $j, 'alquiler' => $a];
            }
            return $alquileres;
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function devolver($id, $cod) {
        try {
            $conex = new Conexion();
            $conex = new Conexion();
            $conex->begin_transaction();
            $conex->query("UPDATE juegos SET Alquilado = 'NO' WHERE Codigo = '$cod'");
            $conex->query("UPDATE alquiler SET Fecha_devol = '" . date('Y-m-d') . "' WHERE id = $id");
            $conex->commit();
            return true;
        } catch (mysqli_sql_exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return true;
        }
    }
}
