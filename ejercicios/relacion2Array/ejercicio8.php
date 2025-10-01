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
        $paises = array(0 => 20, 1 => 30, 2 => 40, 3 => 25, 4 => 35);
        $pos = array_search(25, $paises);
        if (is_int($pos))
            echo "La edad se encuentra en la posición " . $pos;
        else
            echo "La edad no se encuentra en el array";
            ?>
    </body>
</html>
