<?php

class Empleado {

    private $codigo;
    private $clave;
    private $nombrecompleto;
    private $telf;
    private $rol;
    
    public function __construct($codigo, $clave, $nombrecompleto, $telf, $rol) {
        $this->codigo = $codigo;
        $this->clave = $clave;
        $this->nombrecompleto = $nombrecompleto;
        $this->telf = $telf;
        $this->rol = $rol;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function __toString(): string {
        return "Empleado[codigo=" . $this->codigo
                . ", clave=" . $this->clave
                . ", nombrecompleto=" . $this->nombrecompleto
                . ", telf=" . $this->telf
                . ", rol=" . $this->rol
                . "]";
    }

}

