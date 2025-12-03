<?php

require_once 'Conexion.php';
require_once '../model/Cliente.php';

class clienteController {

    public static function insertar($c) {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO cliente VALUES('$c->dni', '$c->nombre', '$c->apellidos', '$c->direccion', '$c->localidad', '$c->clave', '$c->tipo')");
            $fila = $conex->affected_rows;
            $conex->close();
            return $fila;
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }

    public static function verificar($dni, $clave) {
        try {
            $conex = new Conexion();
            $result = $conex->query("SELECT * FROM cliente WHERE dni=$dni");
            if ($result->num_rows == 0) {
                $cliente->false;
            } else {
                $row = $result->fetch_assoc();
                if (password_verify($clave, $row['clave'])) {
                    $cliente = new Cliente($row['dni'], $row['nombre'], $row['apellidos'], $row['direccion'], $row['localidad'], $row['clave'], $row['tipo']);
                } else {
                    $cliente->false;
                }
            }
            return $cliente;
            $conex->close();
        } catch (Exception $exc) {
            echo $exc->getMessage();
            echo $exc->getTraceAsString();
        }
    }
}
