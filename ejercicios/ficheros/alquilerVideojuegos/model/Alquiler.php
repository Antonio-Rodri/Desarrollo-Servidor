<?php

class Alquiler {

    private $id;
    private $Cod_juego;
    private $DNI_cliente;
    private $Fecha_alquiler;
    private $Fecha_devol;
    
    public function __construct($id, $Cod_juego, $DNI_cliente, $Fecha_alquiler, $Fecha_devol) {
        $this->id = $id;
        $this->Cod_juego = $Cod_juego;
        $this->DNI_cliente = $DNI_cliente;
        $this->Fecha_alquiler = $Fecha_alquiler;
        $this->Fecha_devol = $Fecha_devol;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function __toString(): string {
        return "Alquiler[id=" . $this->id
                . ", Cod_juego=" . $this->Cod_juego
                . ", DNI_cliente=" . $this->DNI_cliente
                . ", Fecha_alquiler=" . $this->Fecha_alquiler
                . ", Fecha_devol=" . $this->Fecha_devol
                . "]";
    }

}
