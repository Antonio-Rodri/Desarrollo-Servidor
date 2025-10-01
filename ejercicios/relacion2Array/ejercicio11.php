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
        $numeros = array(0 => 3, 1 => 1, 2 => 4, 3 => 1, 4 => 5, 5 => 9);

        function promedio(array $array) {
            $suma = 0;
            $counter = 0;
            foreach ($array as $value) {
                $suma += $value;
                $counter++;
            }
            return $suma/$counter;
        }

        echo "El promedio del array es: " . promedio($numeros);
        ?>
    </body>
</html>
