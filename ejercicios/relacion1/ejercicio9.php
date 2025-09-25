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
        $num1 = 5;
        $num2 = 10;
        $num3 = 2;

        if ($num1 >= $num2) {
            if ($num3 >= $num1) {
                echo "Los números ordenados son: $num3, $num1, $num2";
            } elseif ($num3 >= $num2) {
                echo "Los números ordenados son: $num1, $num3, $num2";
            } else {
                echo "Los números ordenados son: $num1, $num2, $num3";
            }
        } else {
            if ($num3 >= $num2) {
                echo "Los números ordenados son: $num3, $num2, $num1";
            } elseif ($num3 >= $num1) {
                echo "Los números ordenados son: $num2, $num3, $num1";
            } else {
                echo "Los números ordenados son: $num2, $num1, $num3";
            }
        }
        ?>
    </body>
</html>
