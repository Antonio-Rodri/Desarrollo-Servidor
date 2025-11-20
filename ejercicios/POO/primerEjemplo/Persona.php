<?php

class Persona {

    protected $nombre;
    protected $apellidos;
    protected $edad;
    protected static $numperson = 0;

    public function __construct($n = "Pedro", $a = "Sánchez", $e = "45") {
        $this->nombre = $n;
        $this->apellidos = $a;
        $this->edad = $e;
        self::$numperson++;
    }

    public function __destruct() {
        self::$numperson--;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function __toString(): string {
        return "Persona[nombre=" . $this->nombre
                . ", apellidos=" . $this->apellidos
                . ", edad=" . $this->edad
                . "]";
    }

    public function __clone(): void {
        self::$numperson++;
        $this->edad = 0;
    }

    public function __call(string $name, array $arguments){
        if($name == "modificar"){
            if(count($arguments) == 1){
                $this->nombre = $arguments[0];
            }
            if(count($arguments) == 2){
                $this->nombre = $arguments[0];
                $this->apellidos = $arguments[1];
            }
            if(count($arguments) == 3){
                $this->nombre = $arguments[0];
                $this->apellidos = $arguments[1];
                $this->edad = $arguments[2];
            }
        }
    }

    /*
      public function getNombre() {
      return $this->nombre;
      }

      public function getApellidos() {
      return $this->apellidos;
      }

      public function getEdad() {
      return $this->edad;
      }

      public function setNombre($nombre): void {
      $this->nombre = $nombre;
      }

      public function setApellidos($apellidos): void {
      $this->apellidos = $apellidos;
      }

      public function setEdad($edad): void {
      $this->edad = $edad;
      }
     */

    public static function getNumperson() {
        return self::$numperson;
    }

    public static function setNumperson($numperson): void {
        self::$numperson = $numperson;
    }
}
