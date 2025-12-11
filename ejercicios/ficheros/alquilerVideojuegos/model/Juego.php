<?php

class Juego {

    private $codigo;
    private $nombre_juego;
    private $nombre_consola;
    private $anno;
    private $precio;
    private $alquilado;
    private $imagen;
    private $descripcion;
    
    public function __construct($codigo, $nombre_juego, $nombre_consola, $anno, $precio, $alquilado, $imagen, $descripcion) {
        $this->codigo = $codigo;
        $this->nombre_juego = $nombre_juego;
        $this->nombre_consola = $nombre_consola;
        $this->anno = $anno;
        $this->precio = $precio;
        $this->alquilado = $alquilado;
        $this->imagen = $imagen;
        $this->descripcion = $descripcion;
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

    public function __toString(): string {
        return "Juego[codigo=" . $this->codigo
                . ", nombre_juego=" . $this->nombre_juego
                . ", nombre_consola=" . $this->nombre_consola
                . ", anno=" . $this->anno
                . ", precio=" . $this->precio
                . ", alquilado=" . $this->alquilado
                . ", imagen=" . $this->imagen
                . ", descripcion=" . $this->descripcion
                . "]";
    }
    
    public function generarCodigoCorto() {
        $palabras = explode(' ', $this->nombre_juego);
        $iniciales = '';
        
        foreach ($palabras as $palabra) {
            if (!empty($palabra)) {
                $iniciales .= $palabra[0];
            }
        }
        $this->codigo = $iniciales . '-' . $this->nombre_consola;
    }

}
