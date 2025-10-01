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
        $numeros = array(0 => 3, 1 => 1, 2 => 4, 3 => 1, 4 => 5, 5 => 9, 6 => 4);

        function eliminarDuplicados(array &$array) {
            foreach ($array as $value) {
                $count = 0;
                foreach ($array as $key => $value2) {
                    if($value === $value2){
                        $count++;
                        if($count > 1)
                            unset($array[$key]);
                    }
                }
            }
        }
        eliminarDuplicados($numeros);
        foreach ($numeros as $value) {
            echo $value . " ";
        }
        ?>
    </body>
</html>
