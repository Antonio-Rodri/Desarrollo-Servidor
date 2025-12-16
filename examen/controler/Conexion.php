<?php


class Conexion extends PDO
{
    private $host = "localhost";
    private $usu  = "dwes";
    private $pwd  = "abc123.";
    private $bd   = "taller_mecanico";

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->bd};charset=utf8mb4";
        $opciones = [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_CASE => PDO::CASE_LOWER,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
        ];

        try {
            parent::__construct($dsn, $this->usu, $this->pwd, $opciones);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}