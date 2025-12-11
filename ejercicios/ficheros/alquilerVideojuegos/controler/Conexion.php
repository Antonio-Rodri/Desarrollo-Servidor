<?php

class Conexion extends mysqli{
    private $host = "localhost";
    private $usu = "dwes";
    private $pass = "abc123.";
    private $bd = "alquiler_juegos";
    
    public function __construct(){
        parent::__construct($this->host, $this->usu, $this->pass, $this->bd);
    }

    public function __get(string $name): mixed {
        return $this->$name;
    }

    public function __set(string $name, mixed $value): void {
        $this->$name = $value;
    }

}

/*
class Conexion extends PDO
{
    private $host = "localhost";
    private $usu  = "dwes";
    private $pwd  = "abc123.";
    private $bd   = "banco_bloqueo";

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->bd};charset=utf8mb4";
        $opciones = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // lanzar excepciones en errores
        ];

        try {
            parent::__construct($dsn, $this->usu, $this->pwd, $opciones);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}
 */
