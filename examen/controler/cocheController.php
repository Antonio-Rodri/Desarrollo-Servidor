<?php

require_once '../model/Coche.php';
require_once '../model/Cliente.php';

class cocheController {

    public static function buscarCoches($dni) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM coche WHERE dni_cliente='$dni'");
            $coches = [];
            if ($result->rowCount() == 0) {
                $coches = false;
            } else {
                while ($row = $result->fetch()) {
                    $coche = new Coche($row['matricula'], $row['marca'], $row['modelo'], $row['km'], $row['foto'], $row['dni_cliente']);
                    $coches[] = $coche;
                }
            }
            return $coches;
            $conex->close();
        } catch (Exception $exc) {
            $coches = false;
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return $coches;
        }
    }

    public static function buscar($matricula) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM coche WHERE matricula='$matricula'");
            if ($result->rowCount() == 0) {
                $coche = false;
            } else {
                $row = $result->fetch();
                $coche = new Coche($row['matricula'], $row['marca'], $row['modelo'], $row['km'], $row['foto'], $row['dni_cliente']);
            }
            return $coche;
            $conex->close();
        } catch (Exception $exc) {
            $coche = false;
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return $coche;
        }
    }
}
