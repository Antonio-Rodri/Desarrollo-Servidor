<?php
$datos = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=moriles&lang=sp&units=metric&appid=25079712842d1a0670419810c1c8d228");
var_dump($datos);
echo "<br>";
$tiempo = json_decode($datos);
echo "Temperatura: " . $tiempo->main->temp;
