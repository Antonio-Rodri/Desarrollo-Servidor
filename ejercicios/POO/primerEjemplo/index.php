<?php

require_once 'Persona.php';
require_once 'Empleado.php';

$p = new Persona("Pedro", "Sánchez", 25);
// echo $p->getNombre();
echo "<br>" . Persona::getNumperson();
$p1 = new Persona("Alberto", "Feijoo");
echo "<br>" . Persona::getNumperson();
unset($p1);
echo "<br>" . Persona::getNumperson();
echo "<br>====================<br>";
$p->nombre = "Alejandro";

echo $p->nombre . "<br>";
echo $p . "<br>";

$p2 = clone($p);
$p->nombre = "Pepe";
echo $p . "<br>";
echo $p2 . "<br>";

$p->modificar("Miguel");
echo $p->nombre;
echo "<br>==========Herencia==========<br>";

$e = new Empleado("Paco", "Pérez", 23, 1500)
?>