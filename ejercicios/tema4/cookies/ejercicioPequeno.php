<?php
setcookie("dia", time());

if(isset($_COOKIE['dia'])){
    echo "Hola, tu último acceso fue el dia ";
    echo date("d m Y", $_COOKIE['dia']);
    echo ' a las ' . date("H:i:s", $_COOKIE['dia']);
    
} else {
    echo 'Bienvenido, es la primera vez que accedes';
}