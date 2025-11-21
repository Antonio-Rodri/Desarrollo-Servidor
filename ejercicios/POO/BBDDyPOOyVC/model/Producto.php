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

}
