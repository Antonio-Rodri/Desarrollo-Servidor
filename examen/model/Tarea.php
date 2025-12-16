<?php

class Tarea {

    private $id;
    private $descripcion;
    private $precio;
    private $tipo;

    public function __construct($id, $descripcion, $precio, $tipo) {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->tipo = $tipo;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    /*
      public function __toString(): string {
      return "Tarea[id=" . $this->id
      . ", descripcion=" . $this->descripcion
      . ", precio=" . $this->precio
      . ", tipo=" . $this->tipo
      . "]";
      }
     */
}
