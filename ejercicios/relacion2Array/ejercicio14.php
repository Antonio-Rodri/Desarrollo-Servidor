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
        <table border="1">
            <?php
            $numeros = array(0 => 3, 1 => 1, 2 => 4, 3 => 1, 4 => 5, 5 => 9, 6 => 4);

            function contarDuplicados(array $array) {
                $res = [];
                foreach ($array as $value) {
                    $insideArray = 0;
                    foreach ($res as $key => &$value2) {
                        if ($value === $key) {
                            $value2++;
                            $insideArray++;
                        }
                    }
                    if ($insideArray == 0) {
                        $res[$value] = 1;
                    }
                }
                return $res;
            }

            $respuesta = contarDuplicados($numeros);
            echo "<tr><th>Valor</th><th>Repeticiones</th></tr>";
            foreach ($respuesta as $key => $value) {
                echo "<tr><td>" . $key . "</td><td>" . $value . "</td></tr>";
            }
            ?>
        </table>
    </body>
</html>
