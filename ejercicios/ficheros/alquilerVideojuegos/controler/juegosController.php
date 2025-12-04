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
            $result = $conex->query("SELECT * FROM juegos WHERE codigo='$cod'");
            if ($result->num_rows) {
                $reg = $result->fetch_assoc();
                $j = new Juego($reg['codigo'], $reg['nombre_juego'], $reg['nombre_consola'], $reg['anno'], $reg['precio'], $reg['alquilado'], $reg['imagen'], $reg['descripcion']);
            } else {
                $j = false;
            }
            $conex->close();
            return $j;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function mostrar($cod) {
        switch ($cod) {
            case "Alquilados":
                $sql = "SELECT * FROM juegos where Alquilado = 'SI'";
                break;
            case "NoAlquilados":
                $sql = "SELECT * FROM juegos where Alquilado = 'NO'";
                break;
            default:
                $sql = "SELECT * FROM juegos";
                break;
        }
        
        try {
            $conex = new Conexion();
            $result = $conex->query($sql);
            if ($result->num_rows) {
                while ($fila = $result->fetch_assoc()) {
                    $j = new Juego($fila['Codigo'], $fila['Nombre_juego'], $fila['Nombre_consola'], $fila['Anno'], $fila['Precio'], $fila['Alquilado'], $fila['Imagen'], $fila['descripcion']);
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

    public static function modificar($j) {
        try {
            $conex = new Conexion();
            $stmt = $conex->prepare("UPDATE juegos SET anno = ?, precio = ?, alquilado = ?, imagen = ?, descripcion = ? WHERE Nombre_juego = ? AND Nombre_consola = ?");
            //Esto está mal, no puedo usar llamadas de objetos dentro del bindParam ya que no son direcciones de memoria sino valores literales.
            $stmt->bind_param("iisssss", $j->anno, $j->precio, $j->alquilado, $j->imagen, $j->descripcion, $j->nombre_juego, $j->nombre_consola);
            $stmt->execute();
            $rows = $stmt->affected_rows;
            $conex->close();
            return $rows;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
            $rows = 0;
            return $rows;
        }
    }

    public static function borrar($cod) {
        try {
            $conex = new Conexion();
            $conex->query("DELETE FROM juegos WHERE codigo='$cod'");
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
