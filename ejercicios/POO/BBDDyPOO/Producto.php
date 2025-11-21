<?php

class Producto {

    private $codigo;
    private $nombre;
    private $precio;


    public function __construct($cod = 0, $nombre = "", $precio = 0) {
        $this->codigo = $cod;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    
    public function nuevoProducto($cod, $nombre, $precio) {
        $this->codigo = $cod;
        $this->nombre = $nombre;
        $this->precio = $precio;
    }
    
    public function __toString(): string {
        return "Producto[codigo=" . $this->codigo
                . ", nombre=" . $this->nombre
                . ", precio=" . $this->precio
                . "]<br>";
    }
    
    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    
    public function insertar() {
        try {
            $conex = new Conexion();
            $conex->query("INSERT INTO producto VALUES($this->codigo, '$this->nombre', $this->precio)");
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
            if($result->num_rows){
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
            if($result->num_rows){
                // $p = new self();
                while($fila = $result->fetch_object()){
                    $p = new self($fila->codigo, $fila->nombre, $fila->precio);
                    $productos[]=$p;
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
