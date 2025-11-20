<?php
require_once 'Persona.php';

class Empleado extends Persona {

    private $salario;
    
    public function __construct($n = "Antoñio", $a = "Rodri", $e = "23", $salario) {
        parent::__construct($n, $a, $e);
        $this->salario = $salario;
    }

}