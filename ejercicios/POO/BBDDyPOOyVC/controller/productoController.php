<?php

require_once 'Conexion.php';
require_once '../model/Producto.php';

class productoController {

    public static function insertar($p) {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO producto VALUES($p->codigo, '$p->nombre', $p->precio)");
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
            $result = $conex->query("SELECT * FROM producto WHERE codigo=$cod");
            if ($result->num_rows) {
                $reg = $result->fetch_object();
                $p = new Producto($reg->codigo, $reg->nombre, $reg->precio);
            } else {
                $p->false;
            }
            $conex->close();
            return $p;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function mostrar() {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM producto");
            if ($result->num_rows) {
                // $p = new self();
                while ($fila = $result->fetch_object()) {
                    $p = new Producto($fila->codigo, $fila->nombre, $fila->precio);
                    $productos[] = $p;
                    // $p = new self();
                    // $productos[] = clone($p);
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
}
