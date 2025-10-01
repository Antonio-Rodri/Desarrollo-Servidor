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
        $paises = array(0 => "España", 1 => "Francia", 2 => "Italia", 3 => "Alemania", 4 => "Portugal");
        unset($paises[2]);
        foreach ($paises as $key => $value) {
            echo $value . " ";
        }
        echo "<br>";
        array_pop($paises);
        foreach ($paises as $key => $value) {
            echo $value . " ";
        }
        ?>
    </body>
</html>
