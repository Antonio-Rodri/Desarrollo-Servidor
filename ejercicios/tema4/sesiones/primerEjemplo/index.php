<?php

session_start();
echo $_SESSION['nombre'];
$_SESSION['nombre'] = "Pepe";

?>

<br><a href="datos.php">Ir a datos</a>