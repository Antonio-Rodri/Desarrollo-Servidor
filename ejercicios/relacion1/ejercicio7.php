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
        $suma = 1;
        echo "La suma de los cuadrados de los primeros 100 numeros es: ";
        for ($index = 2; $index < 101; $index++) {
            $suma += pow($index, 2);
        }
        echo "$suma";
        ?>
    </body>
</html>
