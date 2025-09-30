<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $colores = array(0 => "rojo", 1 => "verde", 2 => "azul", 3 => "amarillo");
        echo $colores[0] . " " . $colores[2];
        $colores[] = "naranja";
        foreach ($colores as $value) {
            echo $value;
        }
        ?>
    </body>
</html>
