<?php

require_once '../model/Tarea.php';

class tareaController {

    public static function buscarTarea($tarea) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM tarea WHERE tipo='$tarea'");
            $tareas = [];
            if ($result->rowCount() == 0) {
                $tareas = false;
            } else {
                while ($row = $result->fetch()) {
                    $tarea = new Tarea($row['id'], $row['descripcion'], $row['precio'], $row['tipo']);
                    $tareas[] = $tarea;
                }
            }
            return $tareas;
            $conex->close();
        } catch (Exception $exc) {
            $tareas = false;
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return $tareas;
        }
    }

    public static function buscar($tarea) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM tarea WHERE id='$tarea'");
            if ($result->rowCount() == 0) {
                $tarea = false;
            } else {
                $row = $result->fetch();
                $tarea = new Tarea($row['id'], $row['descripcion'], $row['precio'], $row['tipo']);
            }
            return $tarea;
            $conex->close();
        } catch (Exception $exc) {
            $tarea = false;
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            return $tarea;
        }
    }
}
