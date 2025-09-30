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

        function burbujaAsc(array &$array) {
            $hayCambio = true;

            while ($hayCambio) {
                $hayCambio = false;
                for ($i = 0; $i < count($array) - 1; $i++) {
                    if ($array[$i + 1] < $array[$i]) {
                        $valAux = $array[$i];
                        $array[$i] = $array[$i + 1];
                        $array[$i + 1] = $valAux;
                        $hayCambio = true;
                    }
                }
            }
        }
        
        function burbujaDes(array &$array) {
            $hayCambio = true;

            while ($hayCambio) {
                $hayCambio = false;
                for ($i = 0; $i < count($array) - 1; $i++) {
                    if ($array[$i + 1] > $array[$i]) {
                        $valAux = $array[$i];
                        $array[$i] = $array[$i + 1];
                        $array[$i + 1] = $valAux;
                        $hayCambio = true;
                    }
                }
            }
        }

        burbujaAsc($numeros);
        foreach ($numeros as $value) {
            echo $value." ";
        }
        echo"<br>";
        burbujaDes($numeros);
        foreach ($numeros as $value) {
            echo $value." ";
        }
        ?>
    </body>
</html>
