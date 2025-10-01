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
        $nombres = array(0 => "gato", 1 => "perro", 2 => "elefante", 3 => "jirafa");
        echo count($nombres);
        $nombres[] = "raton";
        $nombres[] = "leon";
        echo count($nombres);
        ?>
    </body>
</html>
