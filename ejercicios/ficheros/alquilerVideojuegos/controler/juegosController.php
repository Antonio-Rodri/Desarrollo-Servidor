<?php

require_once 'Conexion.php';
require_once '../model/Juego.php';

class juegosController {

    public static function insertar($j) {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO juegos VALUES('$j->codigo', '$j->nombre_juego', '$j->nombre_consola', $j->anno, $j->precio, '$j->imagen', '$j->descripcion')");
            $fila = $conex->affected_rows;
            $conex->close();
            return $fila;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function buscar($cod) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos WHERE codigo=$cod");
            if ($result->num_rows) {
                $reg = $result->fetch_assoc();
                $j = new Juego($reg['codigo'], $reg['nombre_juego'], $reg['nombre_consola'], $reg['anno'], $reg['precio'], $reg['alquilado'], $reg['imagen'], $reg['descripcion']);
            } else {
                $j->false;
            }
            $conex->close();
            return $j;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function mostrar() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM juegos");
            if ($result->num_rows) {
                while ($fila = $result->fetch_assoc()) {
                    $j = new Juego($fila['codigo'], $fila['nombre_juego'], $fila['nombre_consola'], $fila['anno'], $fila['precio'], $fila['alquilado'], $fila['imagen'], $fila['descripcion']);
                    $productos[] = $j;
                }
            } else {
                $productos = false;
            }
            $conex->close();
            return $productos;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
    
    public static function borrar($cod) {
        try {
            $conex = new Conexion();
            $conex->query("DELETE FROM juegos WHERE codigo=$cod");
            if ($fila = $conex->affected_rows) {
                $j->true;
            } else {
                $j->false;
            }
            $conex->close();
            return $j;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
