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
        echo "Suma de los 100 primeros números pares";
        $num = 3;
        $cont = 1;
        $suma = 2;
        while ($cont < 100) {
            if ($num % 2 === 0) {
                $suma += $num;
                $cont++;
            }
            $num++;
        }
        echo "$suma";
        ?>
    </body>
</html>
